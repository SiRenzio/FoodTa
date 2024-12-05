<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/history.css">
</head>
<body>
    <section id="history">
        
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <div id="container">
            <?php
                echo "<div id='rowHeader'>";
                    echo "<h3 class='rowHeaderTexts'>Store</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Name</h3>";
                    echo "<h3 class='rowHeaderTexts'>Quantity</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Image</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Qty</h3>";
                    echo "<h3 class='rowHeaderTexts'>Item Total</h3>";
                    echo "<h3 class='rowHeaderTexts'>Rider Name</h3>";
                echo "</div>";

                foreach ($history as $data) {
                    echo "<div class='cartBox'>";
                    echo htmlspecialchars($data->store_name);
                        echo "<div class='cartItemName'>" . htmlspecialchars($data->item_name) . "</div>";
                        echo "<div class='cartItemImage'>";
                            echo "<img src='" . htmlspecialchars($data->item_img) . "' class='item_img' alt='Item Image'>";
                        echo "</div>";
                            echo "<div class='quantityWrapper'>";
                                echo htmlspecialchars($data->quantity) ;
                            echo "</div>";
                        echo "</form>";
                        echo "<div class='cartItemTotal'>" . htmlspecialchars($data->item_total) . "</div>";
                        echo htmlspecialchars($data->full_name);
                    echo "</div>";
                    echo "<hr class='divider'>";
                    
                }
                echo "Subtotal: <div class='cartItemTotal'>" . htmlspecialchars($data->subtotal) . "</div>";
            ?>
</body>
</html>