<?php 
    session_start();

    class Session{
        function __construct(){
            $_SESSION['logState'];
            $_SESSION['logInCheck'];

            $_SESSION['username'];
            $_SESSION['password'];
        }
    }
?>