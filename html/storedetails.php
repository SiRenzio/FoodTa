<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/storedetails.css">
</head>
<body>
    <section class="storeProducts">
        <?php 
        foreach ($items as $storeItems) {
            echo '<div class="productDisplay">';
                echo '<div class="product-image">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($storeItems->item_img) . '" alt="' . htmlspecialchars($storeItems->item_name) . '">';
                echo '</div>';
                echo '<div class="product-details">';
                    echo '<h3>' . htmlspecialchars($storeItems->item_name) . '</h3>';
                    echo '<p>₱' . htmlspecialchars($storeItems->price) . '</p>';
                    echo '<a href="#" class="add-to-cart">Add to Cart</a>';
                echo '</div>';
            echo '</div>';
        }
        ?>
    </section>
</body>
</html>
