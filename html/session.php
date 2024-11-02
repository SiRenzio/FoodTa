<?php 
    session_start();

    class Session{
        function __construct(){
            $_SESSION['logState'];

            $_SESSION['username'];
            $_SESSION['password'];
        }
    }
?>