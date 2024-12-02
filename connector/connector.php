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

        function retrieveStoreItemByID($item_id){
            $items = array();

            $sql = mysqli_query($this->db, "SELECT * FROM inventory WHERE item_id = '$item_id'");

            while($row = mysqli_fetch_object($sql)){
                $items[] = $row;
            }
            return $items;
        }

        function getDeliveryInfo($user_id){
            $data = array();

            $sql = mysqli_query($this->db, "SELECT * FROM delivery WHERE deliveryPerson_id = $user_id");

            while($row = mysqli_fetch_object($sql)){
                $data[] = $row;
            }
            return $data;
        }

        function getExistingRiderProfile($user_id){
            $sql = "SELECT rider_img FROM delivery WHERE deliveryPerson_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
		    $stmt->bind_result($imagePath);
		    $stmt->fetch();
		    $stmt->close();
		    return $imagePath;
        }

        function updateProfile($rider_id, $user, $imagePath){
            $sql = "UPDATE delivery SET rider_username = ?, rider_img = ? WHERE deliveryPerson_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssi", $user, $imagePath, $rider_id);
            if($stmt->execute())
            {
                return "Profile Updated Successfully";
            }
            else
            {
                return "Error";
            }
            $stmt->close();
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

            $sql3 = "SELECT deliveryPerson_id FROM delivery WHERE rider_username = ? AND rider_password = ?";
            $stmt3 = $this->db->prepare($sql3);
            $stmt3->bind_param('ss', $username, $password);
            
            if($stmt3->execute()){
                $stmt3->store_result();
                $stmt3->bind_result($delivery);
                $stmt3->fetch();

                if($delivery){
                    $_SESSION['logState'] = true;
                    $_SESSION['user_id'] = $delivery;
                    $_SESSION['account_type'] = "delivery";
                    $accType = 'delivery';
                    return $accType;
                    $stmt3->close();
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

        function createDeliveryAccount($ridername, $rider_contact, $riderplate, $ridervehicle, $riderstatus, $rider_user, $rider_pass, $imagePath){
            $sql = "INSERT INTO delivery(full_name, contact_no, vehicle_plate, vehicle_name, status, rider_username, rider_password, rider_img) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssssss", $ridername, $rider_contact, $riderplate, $ridervehicle, $riderstatus, $rider_user, $rider_pass, $imagePath);
            
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
                $total = 0;
                $sql = "
                    SELECT 
                        store.store_name, 
                        inventory.item_id,
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
                        cart.customer_id = ?
                ";
                
                // Prepare statement
                $stmt = $this->db->prepare($sql);
                if (!$stmt) {
                    return "Error in preparing query: " . $this->db->error;
                }
            
                // Bind parameters
                $stmt->bind_param('i', $customer_id);
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
        
        function updateQuantity($customer_id, $item_id, $qty) {
            if ($qty != 0) {
                $sql = "UPDATE cart SET quantity = ? WHERE customer_id = ? AND item_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('iii', $qty, $customer_id, $item_id);
            } else {
                $sql = "DELETE FROM cart WHERE customer_id = ? AND item_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('ii', $customer_id, $item_id);
            }
        
            if ($stmt->execute()) {
                return "Item Qty. Updated";
            } else {
                return "Error Updating: " . $stmt->error; 
            }
        }
        
        function checkBalance($customer_id){
            $amt = null;
            $sql = "SELECT foodtawallet FROM customer WHERE customer_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_object()){
                $amt = $row;
            }
            
            $stmt->close();
            
            return $amt;
        }

        function cashIn($amt, $oldAmt, $customer_id){
            $newAmt = $oldAmt + $amt;
            $sql = "UPDATE customer SET foodtawallet = ? WHERE customer_id = ?";
            $stmt = $this->db->prepare($sql);

            $stmt->bind_param('di', $newAmt, $customer_id);
            
            if ($stmt->execute()){
                return 'Cash in succesful';
            } else {
                return 'Cash in error';
            }

        }

        function checkPayment($foodtaWallet, $subtotal, $options){
            $status = "Payment cannot be process";
            if ($foodtaWallet >= $subtotal && $options == 4) {
                $status ="Sufficient Balance! Let's find a driver!";
            }
            else if ($options == 1){
                $status = "Let's find a driver!";
            }
            else if ($foodtaWallet <= $subtotal){
                $status = "You have insufficient balance, please Cash-in";
            }
            else if ($options == 2 || $options == 3){
                $status = "Sufficient Balance! Let's find a driver!";
            } 
            else {
                $status = $status;
            }
            return $status;
        }

        function payOrder($subtotal, $oldAmt, $customer_id){
            $newAmt = $oldAmt - $subtotal;
            $sql = "UPDATE customer SET foodtawallet = ? WHERE customer_id = ?";
            $stmt = $this->db->prepare($sql);

            $stmt->bind_param('di', $newAmt, $customer_id);
            
            if ($stmt->execute()){
                return 'Cash in succesful';
            } else {
                return 'Cash in error';
            }

        }
        function pendingItems($customer_id){
            $sql = "UPDATE cart SET status = 'PENDING' WHERE customer_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $customer_id);
            $stmt->execute();
            $stmt->close();
        }

        function findDriver(){
            $availableDrivers = array();
            $sql = "SELECT * FROM delivery WHERE status = 1";
            $stmt = $this->db->prepare($sql);

            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_object()) {
                $availableDrivers[] = $row;
            }
            return $availableDrivers;
        }

        function addItems($store_id, $item_name, $quantity, $price, $category, $imagePath)
        {
            $sql = "INSERT INTO inventory(store_id, item_name, quantity, price, category, item_img) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('isssss', $store_id, $item_name, $quantity, $price, $category, $imagePath);
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

        function updateItems($item_id, $store_id, $item_name, $quantity, $price, $category, $imagePath)
        {
            $sql = "UPDATE inventory SET store_id = ?, item_name = ?, quantity = ?, price = ?, category = ?, item_img = ? WHERE item_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('isssssi', $store_id, $item_name, $quantity, $price, $category, $imagePath, $item_id);
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

        function deleteItems($item_id, $imagePath, $store_id)
        {
    	    $sql = "DELETE FROM inventory WHERE item_id = ?";
		    $stmt = $this->db->prepare($sql);
		    $stmt->bind_param('i', $item_id);
		    if($stmt->execute())
            {
                if(file_exists($imagePath))
                {
                    unlink($imagePath);
                }
            }
            else
            {
                return "Error";
            }

            $sql2 = "DELETE FROM cart WHERE store_id = ? AND item_id = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param("ii", $store_id, $item_id);
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

        function getExistingItemImage($item_id)
        {
            $sql = "SELECT item_img FROM inventory WHERE item_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $item_id);
            $stmt->execute();
		    $stmt->bind_result($imagePath);
		    $stmt->fetch();
		    $stmt->close();
		    return $imagePath;
        }
    }
?>