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

                //store interface
                case 'update':
                    include('html/StoreInterface/updateProducts.php');
                    break;
                
                case 'add':
                    include('html/StoreInterface/addProducts.php');
                    break;

                case 'delete':
                    include('html/StoreInterface/deleteProducts.php');
                    break;
                //------------------------end-------------------------------//

                case 'order':
                    if (isset($_SESSION['account_type'])){
                        $accType = $_SESSION['account_type'];
                    }
                    //Proceed to LogIn page
                    if($_SESSION['logState'] === false){
                        include('html/login_page.php');
                    }
                    else{
                        if($accType === "customer"){
                            include('html/header.php');
                            $stores=$this->db->retrieveStores();
                            include('html/order.php');
                        }
                        else if($accType === "store"){
                            include('html/header.php');
                            echo "<script> window.location.href='index.php?command=update' </script>";
                        }
                    }
                    //Proceed to Order page
                    
                    break;

                case 'login':
                        //input from login form
                        if($_POST){
                            $username = $_POST['user'];
                            $password = $_POST['pass'];
                            $_SESSION['username'] = $username;
                            $_SESSION['password'] = $password;
    
                            $accType = $this->db->checkLogInInfo($username, $password);
                        }
    
                        //Proceed to LogIn page
                        if($_SESSION['logState'] === false){
                            include('html/login_page.php');
                        }
                        else{
                            if($accType === "customer"){
                                include('html/header.php');
                                $stores=$this->db->retrieveStores();
                                include('html/order.php');
                            }
                            else if($accType === "store"){
                                include('html/header.php');
                                echo "<script> window.location.href='index.php?command=update' </script>";
                            }
                        }
                        //Proceed to Order page
                        
                        break;
                    
                case 'logout': 
                    $_SESSION['logState'] = false;
                    $_SESSION['account_type'] = null;
                    $_SESSION['user_id'] = null;
                    $accType = null;
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
                            $imagePath = "uploads/" . $image;
                            $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
                            $imageSize = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                            $check = $this->db->checkImage($imagePath, $imageFileType, $imageSize);
                            if($check == "OK"){
                                if($result = $this->db->createStoreAccount($storeName, $storeUsername, $storePassword, $storeLocation, $storeDescription, $storeRating, $storeOpeningHr, $storeClosingHr, $storeContact
                                , $imagePath)){
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
                        if ($_REQUEST['cartType'] == 'allCart'){
                            $cartData = $this->db->checkAllCart($_SESSION['user_id']);
                            $cartItems = $cartData['items'];
                            $totalPrice = $cartData['total']; // Overall total price

                            include('html/allcarts.php');
                        }
                        else{
                            $store_id = $_REQUEST['store_id'];
                            $cartData = $this->db->checkCart($store_id, $_SESSION['user_id']);
                            $cartItems = $cartData['items'];
                            $totalPrice = $cartData['total']; // Overall total price

                            include('html/cart.php');
                        }
                        break;
                    case 'wallet':
                        $amt = $this->db->checkBalance($_SESSION['user_id']);
                        include('html/wallet.php');
                        break;
                    case 'payment':
                        break;
                default:
                    include('html/home_page.php');
                    break;
            }
        }
    }
?>
