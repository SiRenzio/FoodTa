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

        function addToCart($user_id, $item_id, $timestamp){
            $sql = "INSERT into cart(user_id, item_id, timestamp) VALUES(? , ? , ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('iis', $user_id, $item_id, $timestamp);
            
            if($stmt->execute()){
                return "Item Added!";
            }
            else{
                return "Error adding item!";
            }
        }

        function checkLoginInfo($username, $password){
            $sql = "SELECT * FROM customer WHERE username = ? AND password = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ss',$username, $password);
            $stmt->execute();
            //$stmt->bind_result($user);
            //$stmt->fetch();

            if($stmt->num_rows>0){
                $_SESSION['logState'] = true;
               // return $user->user_id;
            }
            else{
                echo "error";
            }
        }
        
        function checkSignUpInfo($account_type, $credential, $credential_value){
            $sql = mysqli_query($this->db, "SELECT * FROM '$account_type' WHERE '$credential' = '$credential_value'");
        }

        function createAccount($account_type, $username, $password){
            $sql = mysqli_query($this->db, "INSERT INTO '$account_type'(username, password) VALUES ()");
        }
    }
?>