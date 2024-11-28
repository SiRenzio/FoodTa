<html>
    <head>
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
        <div id = container>
            <?php
                echo "<h1 id = 'storeName'>Cart for ".$cartItems[0]->store_name."</h1>";
                foreach($cartItems as $ci){
                    echo "<div class = 'cartBox'>";
                        echo $ci->item_name;
                        echo "<img src='data:image/jpeg;base64," . base64_encode($ci->item_img). "' class = 'item_img'>";
                }
            ?>
        </div>
    </body>
</html>