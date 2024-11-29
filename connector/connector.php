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

        function addToCart($user_id, $store_id, $item_id) {
            $checkSql = "SELECT quantity FROM cart WHERE customer_id = ? AND store_id = ? AND item_id = ?";
            $checkStmt = $this->db->prepare($checkSql);
            
            if (!$checkStmt) {
                return "Error in preparing query: " . $this->db->error;
            }
        
            $checkStmt->bind_param('iii', $user_id, $store_id, $item_id);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
        
            if ($result->num_rows > 0) {
                // Item exists: Update quantity
                $updateSql = "UPDATE cart SET quantity = quantity + 1 WHERE customer_id = ? AND store_id = ? AND item_id = ?";
                $updateStmt = $this->db->prepare($updateSql);
        
                if (!$updateStmt) {
                    return "Error in preparing update query: " . $this->db->error;
                }
        
                $updateStmt->bind_param('iii', $user_id, $store_id, $item_id);
                
                if ($updateStmt->execute()) {
                    return "Item quantity updated in cart!";
                } else {
                    return "Error in execution: " . $updateStmt->error;
                }
            } else {
                // Item does not exist: Insert new row
                $insertSql = "INSERT INTO cart(customer_id, store_id, item_id, quantity) VALUES(?, ?, ?, 1)";
                $insertStmt = $this->db->prepare($insertSql);
        
                if (!$insertStmt) {
                    return "Error in preparing insert query: " . $this->db->error;
                }
        
                $insertStmt->bind_param('iii', $user_id, $store_id, $item_id);
        
                if ($insertStmt->execute()) {
                    return "Item added to cart!";
                } else {
                    return "Error in execution: " . $insertStmt->error;
                }
            }
        }
        

        function checkLoginInfo($username, $password){  
            $accType = null;
            $sql = "SELECT customer_id FROM customer WHERE username = ? AND user_password = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ss',$username, $password);
            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($user);
                $stmt->fetch();
                if ($user){
                    $_SESSION['logState'] = true;
                    $_SESSION['user_id'] = $user;
                    $_SESSION['account_type'] = "customer";
                    $accType = 'customer';
                    return $accType;
                    $stmt->close();
                }
            }

            $sql2 = "SELECT store_id FROM store WHERE username = ? AND store_password = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param('ss', $username, $password);
            
            if($stmt2->execute()){
                $stmt2->store_result();
                $stmt2->bind_result($store);
                $stmt2->fetch();

                if($store){
                    $_SESSION['logState'] = true;
                    $_SESSION['user_id'] = $store;
                    $_SESSION['account_type'] = "store";
                    $accType = 'store';
                    return $accType;
                    $stmt2->close();
                }
            }
            
            if ($accType == null){
                echo "<script> alert('Incorrect Username or Password'); window.location.href='index.php?command=order' </script>";
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
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image)){
                    $errMessage = "OK";
                }
            }

            return $errMessage;
        }

        function checkAllCart($customer_id){
                $data = array();
                $sql = "
                    SELECT 
                        store.store_name, 
                        inventory.item_name, 
                        inventory.item_img, 
                        inventory.price, 
                        cart.quantity, 
                        (cart.quantity * inventory.price) AS total_price 
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
                        cart.store_id = ? AND cart.customer_id = ?
                ";
                
                // Prepare statement
                $stmt = $this->db->prepare($sql);
                if (!$stmt) {
                    return "Error in preparing query: " . $this->db->error;
                }
            
                // Bind parameters
                $stmt->bind_param('ii', $store_id, $customer_id);
                $stmt->execute();
                $result = $stmt->get_result();
            
                while ($row = $result->fetch_object()) {
                    $data[] = $row;
                }
            
                $stmt->close();
                return $data; 
            }
            

        function checkCart($store_id, $customer_id) {
            $data = array();
            $total = 0; // Initialize total price
            $sql = "
                SELECT 
                    store.store_name, 
                    inventory.item_name, 
                    inventory.item_img, 
                    inventory.price, 
                    cart.quantity, 
                    (cart.quantity * inventory.price) AS subtotal 
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
                    cart.store_id = ? AND cart.customer_id = ?
            ";
            
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                return "Error in preparing query: " . $this->db->error;
            }
        
            $stmt->bind_param('ii', $store_id, $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            while ($row = $result->fetch_object()) {
                $data[] = $row;
                $total += $row->subtotal; // Accumulate total price
            }
        
            $stmt->close();
        
            // Return data and total
            return [
                'items' => $data,
                'total' => $total
            ]; 
        }
        

        function addItems()
        {
            $sql = "INSERT INTO inventory(store_id, item_name, quantity, price, category, item_img) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('isssss', );
            if($stmt->execute())
            {
                return "Item Added Successfully";
            }
            else
            {
                return "Error";
            }
            $stmt->close();
        }

        function updateItems()
        {
            $sql = "UPDATE inventory SET store_id = ?, item_name = ?, quantity = ?, price = ?, category = ?, item_img = ? WHERE item_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('isssss', );
            if($stmt->execute())
            {
                return "Item Updated Successfully";
            }
            else
            {
                return "Error";
            }
            $stmt->close();
        }

        function deleteItem()
        {
    	    $sql = "DELETE FROM inventory WHERE item_id = ?";
		    $stmt = $this->db->prepare($sql);
		    $stmt->bind_param('i',);
		    if($stmt->execute())
            {
                return "Item Deleted Successfully";
            }
            else
            {
                return "Error";
            }
            $stmt->close();
        }
    }
?>