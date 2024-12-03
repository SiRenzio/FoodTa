<?php
    include_once('connector/connector.php');
    $db = new Connector();

    if($_POST){
        $item_id = $_POST['item_id'];
        $store_id = $_POST['store_id'];
        $result = $db->addToCart($_SESSION['user_id'],$store_id ,$item_id);
        echo "<script>alert('$result');</script>";
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/storedetails.css">
</head>
<body>
    <?php 
        $backLink = "index.php?command=order";
        $position = 'right';
        include 'backBTN.php';
    ?>
    <section class="storeProducts">
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
                    if ($storeItems->quantity > 0){
                        echo '<form method="POST" action ="">';  
                            echo '<input type="hidden" name="item_id" value="'.$storeItems->item_id.'">';
                            echo '<input type="hidden" name="store_id" value="'.$storeItems->store_id.'">';
                            echo '<button type = "submit" class="addToCart">Add to Cart</button>';   
                        echo '</form>'; 
                    }
                    else if ($storeItems->quantity < 1){
                        echo '<button type = "submit" class="addToCartUnavail" disabled>Unavailable</button>';
                    }
                    else if ($storeItems->status == 'PENDING'){
                        echo '<button type = "submit" class="addToCartUnavail" disabled>Cannot Order Yet</button>';
                    }
                echo '</div>';
            echo '</div>';
        }
        ?>
    </section>
</body>
</html>

