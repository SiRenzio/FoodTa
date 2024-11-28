<html>
    <head>
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
        <div id = container>
            <?php
                foreach($cartItems as $ci){
                    echo $ci->store_name;
                }
            ?>
        </div>
    </body>
</html>