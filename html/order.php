<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <title>Food Ta Restaurants</title>
</head>
<body>
    <div class="transacBTN">
        
        <a href="index.php?command=cart&cartType=allCart"><img class="cart" src="images/cart.png"></a>
        <a href="index.php?command=wallet"><img class="wallet" src="images/e-wallet.png"></a>
        <a href="index.php?command=history"><img class="" src="images/history.png"></a>
    </div>
    
    <section class="container">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h1 class="serTitle">FOOD TA! Restaurants</h1>
        <div class="store-list">
            <?php
                foreach ($stores as $storeData => $storeTable) {
                    $storeRating = $storeTable->rating;
                    echo "<div class='store-box'>";

                        // Image at the top
                        echo "<div class='image-section'>";
                            echo "<img class='coverphoto' src='" . $storeTable->coverphoto . "' alt='Store Cover'>";
                        echo "</div>";

                        // Details at the bottom
                        echo "<div class='details-section'>";
                            echo "<h2 class='storeName'>". $storeTable->store_name . "</h2>";
                        echo "<div class='rating-container'>";

                        getRating($storeRating);

                        echo " (" . $storeTable->rating . ")";
                        echo "</div>";
                            echo "<p class='location'>Location: " . $storeTable->store_address . "</p>";
                        echo "</div>";

                        // Overlay for hover effect
                        echo "<div class='overlay'>";
                            echo "<div class='order-container'>";
                                echo "<a href='index.php?command=storeDetails&store_id=$storeTable->store_id' class='orderBtn'>Order Now</a>";
                            echo "</div>";
                        echo "</div>";

                    echo "</div>";
                    
                }

                function getRating($storeRating) {
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $storeRating) {
                            echo "<span class='star'>&#9733;</span>"; // Filled star
                        } else {
                            echo "<span class='star'>&#9734;</span>"; // Empty star
                        }
                    }
                }
            ?>
        </div>
    </section>
</body>
</html>
