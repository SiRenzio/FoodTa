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

    }
?>