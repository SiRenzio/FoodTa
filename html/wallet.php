<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/wallet.css">
</head>
<body>
    <div id = container>
        <?php
            echo "Food Ta! Wallet Amt: P". $balance->foodtawallet ."";
        ?>
        <form action="index.php?command=cashIn" method = "post">
            <input type="number" name="amt">
            <input type="submit" value ="Cash-in">
        </form>
    </div>
</body>
</html>