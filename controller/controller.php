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
                include('html/home_page.html');
                break;
            case 'order':
                $stores=$this->db->retrieveStores();
                include('html/order.php');
                break;
            default:
			{
                include('html/home_page.html');
                break;
			}
        }
    }
}
