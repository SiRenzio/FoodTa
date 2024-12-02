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
                case 'add':
                    include('html/StoreInterface/addProducts.php');
                    break;

                case 'addItems':
                    $store_id = $_SESSION['user_id'];
                    $item_name = $_REQUEST['item_name'];
                    $quantity = $_REQUEST['Quantity'];
                    $price = $_REQUEST['Price'];
                    $category = $_REQUEST['Category'];

                    if(!empty($_FILES["fileToUpload"]["name"]))
                    {
                        $image = basename($_FILES["fileToUpload"]["name"]);
                        $imagePath = "uploads/" . $image;
                        $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
                        $imageSize = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                        $check = $this->db->checkImage($imagePath, $imageFileType, $imageSize);
                    }
                    else
                    {
                        $check = "No Images Selected";
                    }

                    if($check == "OK")
                    {
                        $result = $this->db->addItems($store_id, $item_name, $quantity, $price, $category, $imagePath);
                        echo "<script> alert('$result') </script>";
                    }
                    else
                    {
                        echo "<script> alert('$check') </script>";
                    }

                case 'update':
                    $store_id = $_SESSION['user_id'];
                    $_SESSION['action'] = "update";
                    $items = $this->db->retrieveStoreItems($store_id);
                    include('html/StoreInterface/products.php');
                    break;

                case 'updateForm':
                    $item_id = $_REQUEST['item_id'];
                    $items = $this->db->retrieveStoreItemByID($item_id);
                    include('html/StoreInterface/editForm.php');
                    break;

                case 'updateItems':
                    $item_id = $_REQUEST['item_id'];
                    $store_id = $_SESSION['user_id'];
                    $item_name = $_REQUEST['item_name'];
                    $quantity = $_REQUEST['quantity'];
                    $price = $_REQUEST['price'];
                    $category = $_REQUEST['category'];

                    if(!empty($_FILES["fileToUpload"]["name"]))
                    {
                        $image = basename($_FILES["fileToUpload"]["name"]);
                        $imagePath = "uploads/" . $image;
                        $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
                        $imageSize = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                        $check = $this->db->checkImage($imagePath, $imageFileType, $imageSize);

                        if($imagePath != $this->db->getExistingItemImage($item_id))
                        {
                            $existingImage = $this->db->getExistingItemImage($item_id);
                            unlink($existingImage);
                        }
                    }
                    else
                    {
                        $imagePath = $this->db->getExistingItemImage($item_id);
                        $check = "OK";
                    }

                    if($check == "OK")
                    {
                        $result = $this->db->updateItems($item_id, $store_id, $item_name, $quantity, $price, $category, $imagePath);
                        echo "<script> alert('$result'); window.location.href='index.php?command=update'; </script>";
                    }
                    else
                    {
                        echo "<script> alert('$check'); window.location.href='index.php?command=update';</script>";
                    }

                case 'delete':
                    $store_id = $_SESSION['user_id'];
                    $_SESSION['action'] = "delete";
                    $items = $this->db->retrieveStoreItems($store_id);
                    include('html/StoreInterface/products.php');
                    break;

                case 'deleteItems':
                    $item_id = $_REQUEST['item_id'];	
                    $store_id = $_SESSION['user_id'];
                    $imagePath = $this->db->getExistingItemImage($item_id);
                    $result = $this->db->deleteItems($item_id, $imagePath, $store_id);
                    echo "<script> alert ('$result') </script>";
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
                        else if($accType === "delivery"){
                            include('html/header.php');
                            echo "<script> window.location.href='index.php?command=deliveryRider' </script>";
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
                            else if($accType === "delivery"){
                                include('html/header.php');
                                echo "<script> window.location.href='index.php?command=deliveryRider' </script>";
                            }
                        }
                        //Proceed to Order page
                        
                        break;
                    
                case 'logout': 
                    $_SESSION['logState'] = false;
                    $_SESSION['account_type'] = null;
                    $_SESSION['user_id'] = null;
                    $_SESSION['action'] = null;
                    $accType = null;
                    include('html/home_page.php');
                    include('html/header.php');
                    break;

                case 'deliveryRider':
                    include('html/RiderInterface/rider.php');
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

                        case 'delivery':
                            $ridername = $_REQUEST['ridername'];
                            $rider_contact = $_REQUEST['rider_contact'];
                            $riderplate = $_REQUEST['riderplate'];
                            $ridervehicle = $_REQUEST['ridervehicle'];
                            $riderstatus = $_REQUEST['riderstatus'];
                            $rider_user = $_REQUEST['rider_username'];
                            $rider_pass = $_REQUEST['rider_password'];

                            $image = basename($_FILES["fileToUpload"]["name"]);
                            $imagePath = "uploads/" . $image;
                            $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
                            $imageSize = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                            $check = $this->db->checkImage($imagePath, $imageFileType, $imageSize);
                            if($check == "OK"){
                                if($result = $this->db->createDeliveryAccount($ridername, $rider_contact, $riderplate, $ridervehicle, $riderstatus, $rider_user, $rider_pass, $imagePath)){
                                    echo "<script> alert('Account Created Successfully'); window.location.href='index.php?command=order' </script>";
                                }
                                else{
                                    echo "<script> alert('Wrong Input. Please Try Again'); window.location.href='index.php?command=checkRegister&account_type=delivery </script>";
                                }
                            }
                            else{
                                echo "<script> alert('Error'); window.location.href='index.php?command=checkRegister&account_type=delivery </script>";
                            }
                    }
                    break;
                    case 'cart':
                        if ($_REQUEST['cartType'] == 'allCart'){
                            $cartData = $this->db->checkAllCart($_SESSION['user_id']);
                            $cartItems = $cartData['items'];
                            $totalPrice = $cartData['total']; // Overall total price

                            include('html/allcarts.php');
                        }

                        break;
                    case 'updateQty':
                        $qty = $_REQUEST['qty'];
                        $item_id = $_REQUEST['item_id'];
                        $status = $this->db->updateQuantity($_SESSION['user_id'], $item_id, $qty);

                        echo "<script>alert('". $status ."'); window.location.href='index.php?command=cart&cartType=allCart';</script>";
                        break;
                    case 'wallet':
                        $balance = $this->db->checkBalance($_SESSION['user_id']);
                        include('html/wallet.php');
                        break;
                    case 'cashIn':
                        $cashInAmt = $_REQUEST['amt'];
                        $amt = $this->db->checkBalance($_SESSION['user_id']);
                        $oldAmt = $amt->foodtawallet;
                        $status = $this->db->cashIn($cashInAmt, $oldAmt, $_SESSION['user_id']);
                        
                        echo "<script>alert('". $status ."'); window.location.href='index.php?command=wallet;</script>";

                        $balance = $this->db->checkBalance($_SESSION['user_id']);
                        include('html/wallet.php');
                        break;
                    case 'payment':
                        $balance = $this->db->checkBalance($_SESSION['user_id']);
                        $subTotal = $_REQUEST['subTotal'];
                        include('html/payment.php');
                        break;
                    case 'processPayment':
                        if ($_POST) {
                            if (isset($_REQUEST['options'])) {
                                $options = $_REQUEST['options'];
                            } else {
                                $options = 1; // Default to null if not set
                            }
                        
                            switch ($options) {	
                                case 'Cash':
                                    $options = 1;
                                    break;
                                case 'GCash': // Match dropdown case exactly
                                    $options = 2;
                                    break;
                                case 'Card':
                                    $options = 3;
                                    break;
                                case 'FoodtaWallet':
                                    $options = 4;
                                    break;
                                default:
                                    $options = 1; // Default value for unrecognized options
                            }
                        }
                        $status = $this->db->checkPayment($_SESSION['foodtaWalletBal'], $_SESSION['subTotal'], $options);
                        $this->db->pendingItems($_SESSION['user_id']);
                        echo '<script> alert("'.$status.'"); window.location.href="index.php?command=findDriver&option="'.$options.'"";</script>';
                        break;  
                    case 'findDriver':

                        include('html/finddriver.php');
                        break;
                default:
                    include('html/home_page.php');
                    break;
            }
        }
    }
?>
