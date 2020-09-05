<?php


$dbh = new PDO('mysql:host=localhost;dbname=teste', 'root', 'password');

$stmt = $dbh->prepare("SELECT * FROM users WHERE  email LIKE :login" );
$stmt->execute( [ ":login" => $_POST['email'] ] );
$row = $stmt->fetch();

if( $row === TRUE && password_verify( $_POST['email'], $row['password']) ){
    //mise en session des données utilisateurs telles que le login, le nom... 
    //puis on redirige l'utilisateur vers une page protegée
    echo "vous ête authentifiée";

}else{
    echo "Idenfiant ou mdp incorrect";
}

