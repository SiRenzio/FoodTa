<?php
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
                $stores=$this->db->retrieveStores();
                include('html/order.php');
                break;
            case 'storeDetails':
                $store_id = $_GET['store_id'];
                $items=$this->db->retrieveStoreItems($store_id);
                include('html/storedetails.php');
                break;
            default:
			{
                include('html/home_page.php');
                break;
			}
        }
    }
}
