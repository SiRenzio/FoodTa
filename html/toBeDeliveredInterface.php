<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/toBeDeliveredInterface.css">
    <title>Food Ta Restaurants</title>
</head>
<body>
    <!-- Assume Header is included above -->
    
    <section class="container">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <?php
            foreach($details as $d){
                echo '<p>Customer Name: ' . htmlspecialchars($d->full_name) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($d->customer_address) . '</p>';
            }
            echo '<p>Payment: $' . number_format($_SESSION['subTotal'], 2) . '</p>';
        ?>
        <form action="index.php?command=itemDelivered&t_id=<?php echo htmlspecialchars($d->transaction_id); ?>" method="post">
            <input type="submit" value="Complete Order">
        </form>
    </section>
</body>
</html>
