<?php

require('html/session.php');

if(!isset($_SESSION['logState'])){
    $_SESSION['logState'] = false;
}

class Controller
{
    public $db = null;
    function __construct()
    {    
        require_once('connector/connector.php');
        $this->db = new Connector();
    }

    public function getWeb()
    {       
        $command = null;

        if (isset($_REQUEST['command'])) {
            $command = $_REQUEST['command'];
        }

        switch ($command) {
            case 'home':
                include('html/home_page.php');
                break;
            case 'order':
                //input from login form
                if($_POST){
                    $username = $_POST['user'];
                    $password = $_POST['pass'];
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;

                    $this->db->checkLogInInfo($username, $password);
                }

                //Proceed to LogIn page
                if($_SESSION['logState'] === false){
                    include('html/login_page.php');
                }

                //Proceed to Order page
                else{
                    $stores=$this->db->retrieveStores();
                    include('html/order.php');
                }
                
                break;

            case 'logout':
                $_SESSION['logState'] = false;
                include('html/home_page.php');
                break;

            case 'storeDetails':
                $store_id = $_GET['store_id'];
                $items=$this->db->retrieveStoreItems($store_id);
                $stores=$this->db->retrieveStores();
                include('html/storedetails.php');
                break;
            
            case 'register':
                include('html/register_page.php');
                break;
            default:
                include('html/home_page.php');
                break;
        }
    }
}
