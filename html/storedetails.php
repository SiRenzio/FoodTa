<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/storedetails.css">
</head>
<body>
    <section class="storeProducts">
        <a class="backBTN" href="index.php?command=order">Back
            <img src="images/backButton.png" alt="Back Icon">
        </a>
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <?php 
        if ($storeName && count($storeName) > 0) {
            echo "<h2 class='storeName'>Welcome to " . htmlspecialchars($storeName[0]->store_name) . "</h2>";
        }

        foreach ($items as $storeItems) {
            echo '<div class="productCard">';
                echo '<div class="product-image">';
                    echo '<img src="' . htmlspecialchars($storeItems->item_img) . '" alt="' . htmlspecialchars($storeItems->item_name) . '">';
                echo '</div>';

                echo '<div class="product-details">';
                    echo '<h3>' . htmlspecialchars($storeItems->item_name) . '</h3>';
                    echo '<p>₱' . htmlspecialchars($storeItems->price) . '</p>';
                    echo '<form method="POST" action ="">';  
                        echo '<input type="hidden" name="item_id" value="'.$storeItems->item_id.'">';
                        echo '<input type="hidden" name="store_id" value="'.$storeItems->store_id.'">';
                        echo '<button type = "submit" class="addToCart">Add to Cart</button>';   
                    echo '</form>'; 
                echo '</div>';
            echo '</div>';
        }
        ?>
    </section>
</body>
</html>

