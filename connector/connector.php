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

        function retrieveStoreItems($store_id){
            $items = array();

            $sql = mysqli_query($this->db, "SELECT * FROM inventory WHERE store_id = '$store_id'");

            while($row = mysqli_fetch_object($sql)){
                $items[] = $row;
            }
            return $items;
        }

        function addToCart($user_id, $item_id, $quantity){
            $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = $user_id AND item_quantity");
        }

        function checkLoginInfo($username, $password){
            $sql = mysqli_query($this->db, "SELECT * FROM customer WHERE username = '$username' AND password = '$password'");

            if($sql->num_rows>0){
                $_SESSION['logState'] = true;
            }
            else{
                echo "error";
            }
        }

        function createAccount($account_type, $username, $password){
            $sql = mysqli_query($this->db, "INSERT INTO '$account_type'(username, password) VALUES ()");
        }

    }
?>