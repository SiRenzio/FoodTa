<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        .container {
            position: absolute;
            top: 80px;
            padding-bottom: 3em;
        }
    </style>
</head>
<body>
    <section class="container">
        <?php
            if($details){
                foreach($details as $od){
                    echo "<br>" . "Customer: " . $od->full_name . "<br>";
                    echo "Customer Address: " . $od->customer_address . "<br>";
                    echo "Store: " . $od->store_name . "<br>";
                    echo "Item: " . $od->item_name . "<br>";
                    echo "<img src='" . $od->item_img . "' alt='product_image' width='100' height='100'" . "<br><br>";
                    echo "Price: " . $od->price . "<br>";
                    echo "Quantity: " . $od->quantity . "<br>";

                }
                echo '<form action="index.php?orderStarted" method="post">';
                    echo '<input type="hidden" >';
                    echo '<input type="submit" value="Accept Order" class="btn">';
                echo '</form>';
            }
            else{
                echo "<h1>No Orders at the moment.</h1>";
            }
        ?>
    </section>
</body>
</html>