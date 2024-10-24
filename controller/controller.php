<?php
class Controller
{
    function __construct()
    {    
		   
    }

    public function getWeb()
    {       
        $command = null;

        if (isset($_REQUEST['command'])) {
            $command = $_REQUEST['command'];
        }

        switch ($command) {
            case 'home':
            default:
			{
                include('html/home_page.html');
                break;
			}
        }
    }
}
