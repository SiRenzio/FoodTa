<?php

    class Connector{
        public $db = null;

        function __construct()
        {
            try{
                $this->db = new mysqli('localhost', 'root', '', 'foodTaDB');
            }catch(mysqli_sql_exception $e){
                exit('Error');
            }
        }
        
        function retrieveStores(){
            $stores = array();

            $sql = mysqli_query($this->db, "SELECT * FROM store");

            while($row = mysqli_fetch_object($sql)){
                $stores[] = $row;
            }
            return $stores;
        }

        function getStoreName($store_id){
            $items = array();

            $sql = mysqli_query($this->db, "SELECT * FROM store WHERE store_id = '$store_id'");

            while($row = mysqli_fetch_object($sql)){
                $items[] = $row;
            }
            return $items;
        }

        function retrieveStoreItems($store_id){
            $items = array();

            $sql = mysqli_query($this->db, "SELECT * FROM inventory WHERE store_id = '$store_id'");

            while($row = mysqli_fetch_object($sql)){
                $items[] = $row;
            }
            return $items;
        }

        function addToCart($user_id, $item_id){
            $sql = "INSERT INTO cart(user_id, item_id) VALUES(?, ?)";
            
            // Prepare statement
            $stmt = $this->db->prepare($sql);
            
            // Check if prepare failed
            if (!$stmt) {
                return "Error in preparing query: " . $this->db->error;
            }
        
            // Bind parameters
            $stmt->bind_param('ii', $user_id, $item_id);
        
            // Execute the query
            if ($stmt->execute()) {
                return "Item Added!";
            } else {
                // Error if execution fails
                return "Error in execution: " . $stmt->error;
            }
        }
        
        function checkLoginInfo($username, $password){
            $sql = "SELECT customer_id FROM customer WHERE username = ? AND user_password = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ss',$username, $password);

            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($user);
                $stmt->fetch();

                if($stmt->num_rows>0){
                    $_SESSION['logState'] = true;
                    $_SESSION['user_id'] = $user;
                    $_SESSION['account_type'] = "customer";
                }
                else{
                    echo "error";
                }
                $stmt->close();
            }
            
            $sql2 = "SELECT store_id FROM store WHERE username = ? AND store_password = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param('ss', $username, $password);
            
            if($stmt2->execute()){
                $stmt2->store_result();
                $stmt2->bind_result($user);
                $stmt2->fetch();

                if($stmt2->num_rows>0){
                    $_SESSION['logState'] = true;
                    $_SESSION['user_id'] = $user;
                    $_SESSION['account_type'] = "store";
                }
                else{
                    echo "error";
                }
                $stmt2->close();
            }
            else{
                echo "There was an error";
            }
        }

        function createUserAccount($fullname, $username, $password, $location, $contact){
            $sql = "INSERT INTO customer(full_name, customer_address, contact_no, username, user_password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssss", $fullname, $location, $contact, $username, $password);

            if($stmt->execute()){
                return true;
            }

            $stmt->close();
        }

        function createStoreAccount($storeName, $storeUsername, $storePassword, $storeLocation, $storeDescription, $storeRating, $storeOpeningHr, $storeClosingHr, $storeContact
        , $image){
            $sql = "INSERT INTO store(store_name, store_address, contact_no, opening_hr, closing_hr, rating, coverphoto, store_description, username, store_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssssssss", $storeName, $storeLocation, $storeOpeningHr, $storeClosingHr, $storeRating, $storeRating, $image, $storeDescription, $storeUsername
            , $storePassword);

            if($stmt->execute()){
                return true;
            }

            $stmt->close();
        }

        function checkImage($image, $imageFileType, $imageSize){
            $status = 1;
            $errMessage = "";

            if($imageSize !== false){
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                    $errMessage = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    $status = 0;
                }
            }
            else{
                $errMessage = "File is not an Image.";
                $status = 0;
            }

            if($status == 0){
                $errMessage = $errMessage;
            }
            else{
                $errMessage = "OK";
            }

            return $errMessage;
        }
        
        function checkCart($store_id, $customer_id){
            $data = array();
            $sql = "SELECT 
                store.store_name, 
                inventory.item_name, 
                inventory.price 
            FROM 
                cart 
            JOIN 
                store 
            ON 
                cart.store_id = store.store_id 
            JOIN 
                inventory
            ON 
                cart.item_id = inventory.item_id 
            WHERE 
                cart.store_id = ? AND cart.customer_id = ?";
                
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ii', $store_id, $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_object())    		
            {    			
                $data[] = $row;
            }
            $stmt->close();
            return $data; 
        }
    }
?>