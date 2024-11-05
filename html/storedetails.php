<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/storedetails.css">
</head>
<body>
    <section class="storeProducts">
    <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <?php 
        foreach ($stores as $storeTable) {
            echo "<h2 class='storeName'>Welcome to ". $storeTable->store_name . "</h2>";
        }

        foreach ($items as $storeItems) {
            echo '<div class="productDisplay">';
                echo '<div class="productCard">';
                    echo '<div class="product-image">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($storeItems->item_img) . '" alt="' . htmlspecialchars($storeItems->item_name) . '">';
                    echo '</div>';

                    echo '<div class="product-details">';
                        echo '<h3>' . htmlspecialchars($storeItems->item_name) . '</h3>';
                        echo '<p>₱' . htmlspecialchars($storeItems->price) . '</p>';
                        echo '<form method="POST" action ="">';
                            echo '<button type = "submit" name = "addToCart" value = 1 class = "addToCart">Add to Cart</button>';
                        echo '</form>'; 
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            if(isset($_POST['quantity'])){
                $quantity = $_POST['quantity'];
                // addToCart($storeItems->item_id, $quantity, $storeItems->name, $storeItems->price);
            }

        }
        
        // function addToCart($item_id, $quantity, $name, $price){
        //     session_start();

        //     if (!isset($_SESSION['cart'])){
        //         $_SESSION['cart'] = [];
        //     }

        //     $itemExists = false;

        //     foreach($_SESSION['cart'] as $items){
        //         if ($items['id'] == $item_id){
        //             $items['quantity'] += $quantity;
        //             $itemExists = true;
        //         }
        //     }

        //     if (!$itemExists){
        //         $_SESSION['cart'][] = [
        //             'id' => $item_id,
        //             'name' => $name,
        //             'price' => $price,
        //             'quantity' => $quantity
        //         ];
        //     }
        // }
        ?>
    </section>
</body>
</html>
