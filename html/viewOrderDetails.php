<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/viewOrderDetails.css">
    <title>Select Drivers</title>
</head>
<body>
    <?php 
        $backLink = "index.php?command=deliveryRider";
        $position = 'right';
        include 'backBTN.php';
    ?>
    <section class="viewDetails">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h1>Customer Order Details</h1>
        <ul class="order-list">
            <?php
                $order = null;
                if ($details) {
                    foreach ($details as $index => $od) {
                        echo "<li class='order-item'>";
                        echo "<div class='order-info'>";
                        echo "<p><strong>Customer:</strong> " . $od->full_name . "</p>";
                        echo "<p><strong>Address:</strong> " . $od->customer_address . "</p>";
                        echo "<p><strong>Store:</strong> " . $od->store_name . "</p>";
                        echo "<p><strong>Item:</strong> " . $od->item_name . "</p>";
                        echo "<p><strong>Price:</strong> $" . $od->price . "</p>";
                        echo "<p><strong>Quantity:</strong> " . $od->quantity . "</p>";
                        echo "</div>";
                        echo "<div class='order-image'>";
                        echo "<img src='" . $od->item_img . "' alt='product image'>";
                        echo "</div>";
                        echo "</li>";

                        if ($index === count($details) - 1 || (isset($details[$index + 1]) && $details[$index + 1]->customer_id != $od->customer_id)) {
                            echo "<div class='accept-button-container'>";
                            echo "<form action=\"index.php?command=orderStarted&cu_id=" . $od->customer_id . "&i_id=" . $od->item_id . "&quantity=" . $od->quantity . "\" method=\"post\">";
                            echo "<input type=\"submit\" value=\"Accept Order\" class=\"btn\">";
                            echo "</form>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<h2>No Orders at the moment.</h2>";
                }
            ?>
        </ul>
    </section>
</body>
</html>
