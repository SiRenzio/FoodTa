<?php
    echo '<title>FOOD TA!</title>';

    echo "<div";
    include('html/header.php');
    echo "</div>";

    echo "<div>";                
    include_once('controller/controller.php');
    $controller = new Controller();
    $controller->getWeb();
    echo "</div>";
    
    echo "<div";
    include_once('html/footer.html');
    echo "</div>";
?>
