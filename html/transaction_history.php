<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/history.css">
    <title>Delivery Person</title>
</head>
<body>
    <section id="history">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h1>Transaction History</h1>
        <div id="container">
            <?php
                echo "<div id='rowHeader'>";
                    echo "<h3 class='rowHeaderTexts'>Store</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Name</h3>";
                    echo "<h3 class='rowHeaderTexts'>Quantity</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Image</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Total</h3>";
                    echo "<h3 class='rowHeaderTexts'>Rider Name</h3>";
                echo "</div>";

                foreach ($history as $data) {
                    echo "<div class='cartBox'>";
                    echo "<div class='cartItemStore'>" . htmlspecialchars($data->store_name) . "</div>";
                    echo "<div class='cartItemName'>" . htmlspecialchars($data->item_name) . "</div>";
                    echo "<div class='cartItemQty'>" . htmlspecialchars($data->quantity) . "</div>";
                    echo "<div class='cartItemImage'><img src='" . htmlspecialchars($data->item_img) . "' class='item_img' alt='Item Image'></div>";
                    echo "<div class='cartItemTotal'>" . htmlspecialchars($data->item_total) . "</div>";
                    echo "<div class='cartItemRider'>" . htmlspecialchars($data->full_name) . "</div>";
                    echo "</div>";
                    echo "<hr class='divider'>";
                }
            ?>
        </div>
    </section>
</body>
</html>
