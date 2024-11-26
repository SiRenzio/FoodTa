<?php
    include_once('connector/connector.php');
    $db = new Connector();

    if($_POST){
        $item_id = $_POST['id'];
        $result = $db->addToCart($_SESSION['user_id'],$item_id);
        echo "<script>alert('$result');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/storedetails.css">
</head>
<body>
    <section class="storeProducts">
    <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <?php 
        if ($storeName && count($storeName) > 0) {
            echo "<h2 class='storeName'>Welcome to " . htmlspecialchars($storeName[0]->store_name) . "</h2>";
        }

        foreach ($items as $storeItems) {
            echo '<div class="productCard">';
                echo '<div class="product-image">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($storeItems->item_img) . '" alt="' . htmlspecialchars($storeItems->item_name) . '">';
                echo '</div>';

                echo '<div class="product-details">';
                    echo '<h3>' . htmlspecialchars($storeItems->item_name) . '</h3>';
                    echo '<p>₱' . htmlspecialchars($storeItems->price) . '</p>';
                    echo '<form method="POST" action ="">';  
                        echo '<input type="hidden" name="id" value="'.$storeItems->item_id.'">';
                        echo '<button type = "submit" class="addToCart">Add to Cart</button>';   
                    echo '</form>'; 
                echo '</div>';
            echo '</div>';
        }
        ?>
    </section>
</body>
</html>

