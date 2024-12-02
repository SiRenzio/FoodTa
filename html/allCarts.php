<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/allCart.css">
</head>
<body>
    <section class="allCart">
        <?php 
            $backLink = "index.php?command=order";
            $position = 'right';
            include 'backBTN.php';
        ?>
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
                                echo "<input type='number' value='" . htmlspecialchars($ci->quantity) . "' class='quantity' name='qty'>";
                            echo "</div>";
                            echo "<input type='submit' value='Update Qty' class='updateBtn'>";
                        echo "</form>";
                        echo "<div class='cartItemTotal'>" . htmlspecialchars($ci->subtotal) . "</div>";
                    echo "</div>";
                    echo "<hr class='divider'>";
                }
                echo "<div class='cartFooter'>";
                    echo"<form action='index.php?command=payment&subTotal=$totalPrice' method='post'>";
                        echo "<p>Subtotal: " . htmlspecialchars($totalPrice) . "</p>";
                        echo "<button type = 'submit' class='checkoutBtn'>Check Out</button>";
                echo "</div>";

                //TODO JV:
                // 1. Islan ang allCarts, kayuhon. Kag ma add sng Button sa order page nga ga link sa allCarts
                // 2. If possible ma categorize tani ang stores kung which carts sila ga belonggg
                // 3. Search sa allCarts if possible
                // 
                // DB 
                // 1. For db naman tni mas mayo if maka pass kita sng single table tapos dira tana ma identify
                // tanan ta nga items, aton subtotal. Which later on, will be passed to orders nga table and then payment.

                // Understand logic of code gid.
            ?>
        </div>
    </section>
</body>
</html>