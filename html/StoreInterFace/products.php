<?php include('html/StoreInterface/sideBar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updateProducts.css">
    <title>Food Ta Restaurants</title>
</head>
<body>
<section class="container">
        <!-- <h1 class="serTitle">This is Update Page</h1> -->
            <table>
				<thead>
				<tr>
                    <th align="center">Product Image</th>
					<th align="center">Product Name</th>
					<th align="center">Quantity</th>
					<th align="center">Price</th>
					<th align="center">Category</th>
				</tr>
				</thead>
				<tfoot>
				<tbody>
				<?php
					if(!empty($items)){
						foreach($items as $storeItems)
						{
							echo "<tr>";
                                echo "<td>" . "<img src='" . $storeItems->item_img . "' alt='item_img' width='100px' height='100px'>" . "<br>" . "</td>";
								echo "<td>". $storeItems->item_name ."</td>";
								echo "<td>". $storeItems->quantity ."</td>";	
								echo "<td>". $storeItems->price ."</td>";
                                echo "<td>". $storeItems->category ."</td>";
                                if($_SESSION['action'] == "update")
                                {
                                    echo "<td><a href='index.php?command=updateItems&item_id=$storeItems->item_id'>Edit</a></td>";
                                }
                                else if($_SESSION['action'] == "delete")
                                {
                                    echo "<td><a href='index.php?command=deleteItems&item_id=".$storeItems->item_id."' onclick='return confirm(\"Are you sure you want to do Delete ". $storeItems->item_name."?\")'>Delete</a></td>";
                                }
							echo "</tr>";
						}
					} else {
						echo "<tr>";
							echo "<td colspan = 5 style = 'height: 100px;'>No Retreived Pokemon</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
    </section>
</body>
</html>