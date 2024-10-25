<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <table>
        <?php
            foreach($stores as $storeData=>$storeTable){
                $storeRating = $storeTable->rating;
                echo "<div id = container>";
                    echo "<td><a href='index.php?command=storeDetails&id=$storeTable->store_id'>" . $storeTable->store_name . "</a>";
                        echo getRating($storeRating) . "(" . $storeTable->rating . ")";
                        echo "<div id = location>Location: ";
                            echo $storeTable->store_address;
                        echo "</div>";
                        echo "<button>Order Now</button>";
                    echo "</td>";
                echo "</div>";
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
</body>
</html>