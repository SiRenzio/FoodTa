<?php
    require('html/session.php');
    if(!isset($_SESSION['logState'])){
        $_SESSION['logState'] = false;
    }

    class Controller
    {   
        public $db = null;
        public $user = '';
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
            include('html/header.php');

            switch ($command) {
                case 'home':
                    include('html/home_page.php');
                    break;

                case 'order':
                    //input from login form
                    $account = $_SESSION['account_type'];
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
                    else{
                        if($account === "customer"){
                            include('html/header.php');
                            $stores=$this->db->retrieveStores();
                            include('html/order.php');
                        }
                        else if($account === "store"){
                            include('html/header.php');
                            $store_id = $_SESSION['user_id'];
                            $items=$this->db->retrieveStoreItems($store_id);
                            include('html/storeInterface.php');
                        }
                        else{
                            echo "<script> alert('Incorrect Username or Password'); window.location.href='index.php?command=order' </script>";
                        }
                    }
                    //Proceed to Order page
                    
                    break;
                    
                case 'logout': 
                    $_SESSION['logState'] = false;
                    include('html/home_page.php');
                    include('html/header.php');
                    break;

                case 'storeDetails':
                    $store_id = $_GET['store_id'];
                    $items=$this->db->retrieveStoreItems($store_id);

                    $storeId = $_GET['store_id'];
                    $storeName=$this->db->getStoreName($storeId);
                    include('html/storedetails.php');
                    break;
                
                case 'register':
                    include('html/register_page.php');
                    break;
                
                case 'checkRegister':
                    $credential = null;
                    $credential_value = null;

                    // $fullname = $_POST['fullname'];
                    // $password = $_POST['password'];
                    // $location = $_POST['location'];
                    // $contact = $_POST['contact'];
                    $account_type = $_GET['accType'];

                    switch($account_type){
                        case 'customer':
                            $fullname = $_REQUEST['fullname'];
                            $username = $_REQUEST['user'];
                            $password = $_REQUEST['pass'];
                            $location = $_REQUEST['loc'];
                            $contact = $_REQUEST['contact'];

                            if($result = $this->db->createUserAccount($fullname, $username, $password, $location, $contact)){
                                echo "<script> alert('Account Created Successfully'); window.location.href='index.php?command=order' </script>";
                            }
                            else{
                                echo "<script> alert('Wrong Input. Please Try Again'); window.location.href='index.php?command=checkRegister&account_type=customer </script>";
                            }
                            // $credential = 'username';
                            // $credential_value = $_POST['username'];
                            break;
                        case 'store':
                            $storeName = $_REQUEST['storename'];
                            $storeUsername = $_REQUEST['store_user'];
                            $storePassword = $_REQUEST['store_pass'];
                            $storeLocation = $_REQUEST['store_loc'];
                            $storeDescription = $_REQUEST['desc'];
                            $storeRating = $_REQUEST['rating'];
                            $storeOpeningHr = $_REQUEST['opening_hr'];
                            $storeClosingHr = $_REQUEST['closing_hr'];
                            $storeContact = $_REQUEST['store_contact'];

                            $image = basename($_FILES["fileToUpload"]["name"]);
                            $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
                            $imageSize = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                            $check = $this->db->checkImage($image, $imageFileType, $imageSize);
                            if($check == "OK"){
                                if($result = $this->db->createStoreAccount($storeName, $storeUsername, $storePassword, $storeLocation, $storeDescription, $storeRating, $storeOpeningHr, $storeClosingHr, $storeContact
                                , $image)){
                                    echo "<script> alert('Account Created Successfully'); window.location.href='index.php?command=order' </script>";
                                }
                                else{
                                    echo "<script> alert('Wrong Input. Please Try Again'); window.location.href='index.php?command=checkRegister&account_type=store </script>";
                                }
                            }
                            else{
                                echo "<script> alert('Error'); window.location.href='index.php?command=checkRegister&account_type=store </script>";
                            }
                            // $credential = 'store_name';
                            // $credential_value = $_POST['storename'];
                            break;
                    }
                    break;
                    case 'cart':
                        $store_id = $_REQUEST['store_id'];
                        $cartItems = $this->db->checkCart($store_id, $_SESSION['user_id']);
                        include('html/cart.php');
                        break;
                default:
                    include('html/home_page.php');
                    break;
            }
        }
    }
?>
