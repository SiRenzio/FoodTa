<!DOCTYPE html>
<html lang="en">
<head>
    <link rel = "stylesheet" href = "css/payment.css">
</head>
<body>
    <div id = "container">
        <?php
            $_SESSION['subTotal'] = $subTotal;  
            $_SESSION['foodtaWalletBal'] = $balance->foodtawallet; 
            echo "Payment = $subTotal";
            echo "Balance = $balance->foodtawallet";
        ?>
    </div>
    <?php
        echo "<form action='index.php?command=processPayment' method = 'post'>";
            echo "Choose a payment method";
            echo "<select id='options' name='options'>";
                echo "<option value='Cash'>Cash</option>";
                echo "<option value='GCash'>GCash</option>";
                echo "<option value='Card'>Card</option>";
                echo "<option value='FoodtaWallet'>FoodtaWallet</option>";
            echo "</select>";
            echo "<input type='submit' value = 'Select'>";
        echo "</form>";
    ?>
</body>
</html>