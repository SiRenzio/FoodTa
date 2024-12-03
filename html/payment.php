<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/payment.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <?php 
        $backLink = "index.php?command=cart&cartType=allCart";
        $position = 'right';
        include 'backBTN.php';
    ?>
    <section class="paymentInfo">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h2>Pay Your Order</h2>
        <div id="container">
            <div class="payment-info">
                <?php
                    $shippingFee = 39;
                    $_SESSION['subTotal'] = $subTotal;  
                    $_SESSION['foodtaWalletBal'] = $balance->foodtawallet; 

                    $total = $subTotal + $shippingFee;
                    echo "<div class='payment-line'><span class='total'>Sub-total</span><span class='line'></span>$subTotal</span></div>";
                    echo "<div class='payment-line'><span>Shipping Fee</span><span class='line'></span>$shippingFee</span></div>";
                    echo "<hr>";
                    echo "<div class='payment-line'><span class='total'>Total</span><span class='line'></span>$total</span></div>";
                    echo "<div class='payment-line'><span>Balance</span><span class='line'></span>$balance->foodtawallet</span></div>";
                ?>
            </div>
            <hr>
            <form action="index.php?command=processPayment" method="post" class="payment-form">
                <label for="options">Choose a payment method:</label>
                <select id="options" name="options">
                    <option value="Cash">COD</option>
                    <option value="GCash">GCash</option>
                    <option value="Card">Card</option>
                    <option value="FoodtaWallet">Food Ta! E-Wallet</option>
                </select>
                <input type="submit" value="Proceed Payment">
            </form>
        </div>
    </section>
</body>
</html>
