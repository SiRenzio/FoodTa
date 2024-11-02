<?php 
    session_start();

    class Session{
        function __construct(){
            $_SESSION['logState'] = false;
            $_SESSION['logInCheck'] = false;

            $_SESSION['username'];
            $_SESSION['password'];
        }
    }
?>