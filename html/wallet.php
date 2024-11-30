<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/wallet.css">
</head>
<body>
    <div id = container>
        <?php
            echo "Gcash Amt: P". $amt->gcash ."";
            echo "Card Balance: P". $amt->card ."";
        ?>
    </div>
</body>
</html>