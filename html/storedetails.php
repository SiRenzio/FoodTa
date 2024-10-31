<!DOCTYPE html>
<html lang="en">
<head>
    <link rel=stylesheet href='css/storedetails.css'>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th width = 12.5% align="center">Image</th>
                <th width = 12.5% align="center">Name</th>
                <th width = 12.5% align="center">Price</th>
                <th width = 12.5% align="center"></th>
            </tr>
        </thead>
        <tfoot>
        <tbody>
            <tr>
                <?php
                    foreach($items as $storeItems){
                        echo "<tr id = row>";
                            echo "<td><img class=item_img src='data:image/jpeg;base64," . base64_encode($storeItems->item_img) . "'>";
                            echo "<td>". $storeItems->item_name ."</td>";
                            echo "<td>₱". $storeItems->price ."</td>";
                            echo "<td>Add to Cart</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </tbody>
    </table>
</body>
</html>