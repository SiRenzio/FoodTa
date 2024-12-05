<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <section id="history">
        
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <div id="container">
            <?php
                echo "<div id='rowHeader'>";
                    echo "<h3 class='rowHeaderTexts'>Name</h3>";
                    echo "<h3 class='rowHeaderTexts'>Image</h3>";
                    echo "<h3 class='rowHeaderTexts'>Quantity</h3>";
                    echo "<h3 class='rowHeaderTexts'>Total</h3>";
                echo "</div>";

                foreach ($cartItems as $ci) {
                    echo "<div class='cartBox'>";
                        echo "<div class='cartItemName'>" . htmlspecialchars($ci->item_name) . "</div>";
                        echo "<div class='cartItemImage'>";
                            echo "<img src='" . htmlspecialchars($ci->item_img) . "' class='item_img' alt='Item Image'>";
                        echo "</div>";
                        echo "<form action='index.php?command=updateQty&item_id=" . htmlspecialchars($ci->item_id) . "' method='post'>";
                            echo "<div class='quantityWrapper'>";
                                echo "<input type='number' min='0' value='" . htmlspecialchars($ci->quantity) . "' class='quantity' name='qty'>";
                            echo "</div>";
                            echo "<input type='submit' value='Update Qty' class='updateBtn'>";
                        echo "</form>";
                        echo "<div class='cartItemTotal'>" . htmlspecialchars($ci->subtotal) . "</div>";
                    echo "</div>";
                    echo "<hr class='divider'>";
                }
</body>
</html>