<html>
    <head>
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
        <div id = container>
            <?php
                echo "<h1 id = 'storeName'>Cart for ".$cartItems[0]->store_name."</h1>";
                    echo "<div id = rowHeader>";
                        echo "<h3 class = rowHeaderTexts>Name</h3>";
                        echo "<h3 class = rowHeaderTexts></h3>";
                        echo "<h3 class = rowHeaderTexts>Quantity</h3>";
                        echo "<h3 class = rowHeaderTexts>Total</h3>";
                    echo "</div>";
                foreach($cartItems as $ci){
                    echo "<div class = 'cartBox'>";
                        echo $ci->item_name;
                        echo "<img src='data:image/jpeg;base64," . base64_encode($ci->item_img). "' class = 'item_img'>";
                        echo "<input type='text' value='$ci->quantity' class = 'quantity' name = 'quantity'>";
                        echo "<input type='submit' value='Update Qty.'>";
                        echo $ci->subtotal;
                    echo "</div>";
                }
                echo "Subtotal: $totalPrice";
                echo "<input type='submit' value='Check Out'>";
            ?>
        </div>
    </body>
</html>