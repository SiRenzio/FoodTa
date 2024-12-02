<?php
    include_once('connector/connector.php');
    $db = new Connector();
    
    $status = $db->checkPayment($balance->foodtawallet, $subTotal);
    echo "<script>alert('$status');</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "stylesheet" href = "css/payment.css">
</head>
<body>
    <div id = "container">
        <?php
            echo "Payment = $subTotal";
            echo "Balance = $balance->foodtawallet";
        ?>
    </div>
</body>
</html>