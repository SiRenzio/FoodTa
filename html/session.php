<?php 
    session_start();

    class Session{
        function __construct(){
            $_SESSION['logState'];

            $_SESSION['username'];
            $_SESSION['password'];
            $_SESSION['user_id'];
            $_SESSION['selectedStore'];
            $_SESSION['account_type'];
            $_SESSION['action'];
        }
    }
?>