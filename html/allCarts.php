<html>
    <head>
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
        <div id = container>
            <?php
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
    </body>
</html>