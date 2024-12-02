<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ta! Wallet</title>
    <link rel="stylesheet" href="css/wallet.css">
</head>
<body>
    <?php 
        $backLink = "index.php?command=order";
        $position = 'right';
        include 'backBTN.php';
    ?>
    <section class="wallet">
    <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <div id="container">
            <h2>Food Ta! Wallet</h2>
            <?php
                echo "<p>Current Amount: P" . htmlspecialchars($balance->foodtawallet) . "</p>";
            ?>
            <form action="index.php?command=cashIn" method="post">
                <input type="number" name="amt" min="0" placeholder="Enter amount" required>
                <input type="submit" value="Cash In">
            </form>
        </div>
    </section>
</body>
</html>
