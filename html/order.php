<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <div class="container"> <!-- Add a container div around the table -->
        <table>
            <?php
                foreach($stores as $storeData=>$storeTable){
                    $storeRating = $storeTable->rating;
                    echo "<tr class='store-row'>"; // Replace div with tr to make table structure correct

                        echo "<td><img class='coverphoto' src='data:image/jpeg;base64," . base64_encode($storeTable->coverphoto) . "'>";
                        echo "<br>" . $storeTable->store_name . "</a>";
                            echo getRating($storeRating) . " (" . $storeTable->rating . ")";
                            echo "<div class='location'>Location: ";
                                echo $storeTable->store_address;
                            echo "</div>";
                            echo "<a href='index.php?command=storeDetails&&store_id=$storeTable->store_id' class = orderBtn>Order Now</a>";
                        echo "</td>";

                    echo "</tr>";
                }

                function getRating($storeRating){
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $storeRating) {
                            echo "<span class='star'>&#9733;</span>"; // Filled star
                        } else {
                            echo "<span class='star'>&#9734;</span>"; // Empty star
                        }
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
