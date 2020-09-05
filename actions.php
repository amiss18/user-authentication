<?php
session_start();
require_once 'functions.php';


// authenficate
if (  isset( $_GET['action'] ) && $_GET['action']=='login' ) {  
       if( isset($_POST['email'], $_POST['password'] ) ) {
            $errors = isValid($_POST);
            if ( count($errors) > 0 ){
                require_once 'login.php';
            }else{
                
            $result= authenticate($_POST['email'], $_POST['password']);
            if( $result === true )
                    header('Location: back/dashboard.php');
                else{
                    $errors[]="Login or password failed" ;
                    require_once 'login.php';
                }
                
            }
       }else
            require_once 'login.php';
}

// registration
if (  isset( $_GET['action'] ) && $_GET['action']=='register' ) {  
    if( isset($_POST['email'], $_POST['password'],$_POST['name'] ) ) {
         $errors = isValid($_POST);
         if ( count($errors) > 0 ){
             require_once 'register.php';
         }else{
             $result =register($_POST['email'], $_POST['password'],  $_POST['name'] );
             
            if( $result === true ){
                authenticate($_POST['email'], $_POST['password']);
                header('Location: back/dashboard.php');
            }
                else{
                    $errors[]="Could not register user" ;
                    require_once 'register.php';
                }
             
         }
    }else
         require_once 'register.php';
}


// logout
if (  isset( $_GET['action'] ) && $_GET['action']=='logout' ) {  
    logout();
    header('Location: index.php');
}

    
 
