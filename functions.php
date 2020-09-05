<?php

require_once 'config.php';

/**
 * connection au serveur mysql avec PDO
 *
 * @return PDO|null
 */
function connect() {

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = sprintf( "mysql:host=%s;dbname=%s;charset=%s;port=%s", HOST, DATABASE,CHARSET, PORT );
    try {
         $pdo = new \PDO($dsn, USER, PASSWORD, $options);
         return $pdo;
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), $e->getCode());
    }
    return null;
}

/**
 * select query
 *
 * @param string $sql requête SQL
 * @param array|null $params paramètres de la requête
 * @return \PDOStatement
 */
function buildQuery( string $sql, ?array $params =[] ):\PDOStatement {
    if( empty( $params ) )
        return connect()->query( $sql );
    $stmt = connect()->prepare($sql);
    $stmt->execute( $params );
    return $stmt;
}

/**
 * insert|update|delete sql
 *
 * @param string $sql
 * @param array $params
 * @return boolean
 */
function addQuery( string $sql, array $params ):bool {
   $stmt = connect()->prepare($sql);
   return $stmt->execute( $params );
}

/**
 * vérifie l'unicité de l'email
 *
 * @param string $login
 * @return boolean true si l'email n'existe , false sinon
 */
function loginVerify( string $login ):bool {
    
    $stmt = buildQuery("SELECT COUNT(*) AS len FROM users WHERE  email LIKE :login", [ ":login" => $login] );
    $row = $stmt->fetch();
    if( $row['len'] === 0 ) return true;
    return false;
}

/**
 *  authenfie l'utilisateur à l'aide du login et du mot de passe
 * @param string $login
 * @param string $password
 * @return boolean false si échec authenfication, true sinon
 */
function authenticate( string $login, string $password ):bool {
    
    $stmt = buildQuery("SELECT * FROM users WHERE  email LIKE :login", [ ":login" => $login]);
    $row = $stmt->fetch();
    if( $row === false ) return false;
    session_regenerate_id();// renouvel l'identifiant de session 
    //on compare le hash du password stocké en BD avec celui entré par l'utilisateur
    if(password_verify( $password, $row['password'])) {
        $_SESSION['user'] = [
            'login' => $row['password'],
            'name' => $row['name'],
            'status' => $row['status'],
            
        ];
        return true;
    }
  
    return false;
    
}

function register( string $login, string $password , string $name, ?string $status="ROLE_USER") :bool{

    $passwordHash = password_hash( $password,PASSWORD_BCRYPT);
    $sql ="INSERT INTO users (name, email, password, created_at, status) VALUES( :name, :login, :password, NOW(),:status ) ";
    $result = addQuery($sql, [
        ":name" => $name,
        ":login" => $login,
        ":password" => $passwordHash,
        ":status" => $status,
    ]);

    return $result;

}

function logout(){
    $_SESSION['user'] = array();
}

/**
 * validation des données
 *
 * @param array $data
 * @return array
 */
function isValid( array $data ) :array {
    $errors = [];
    $data = array_map('trim', $data);
    
    if( isset($data['password']) && mb_strlen( $data['password'] ) < 3 )
        $errors['password'] ="Password must contain 3+ characters";


    if( isset($data['name']) && mb_strlen( $data['name'] ) < 2 )
        $errors['name'] ="Name is required";

    if( isset($data['email'])  ) {
        $isEmail = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        if( $isEmail === false )
            $errors['email'] ="Invalide email";
    }    
    

    return $errors;    
};


