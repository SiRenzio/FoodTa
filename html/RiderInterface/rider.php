<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rider.css">
    <title>Delivery Person</title>
</head>
<body>
    <section class="container">
        <div id="order">
            <h1><?php echo $orderCount->order_count ?> delivery orders found!</h1>
            <a href="index.php?command=viewOrderDetailsForDeliveryPerson">View Details ></a>
        </div>
        <div id="profile">
            <div class="profile-contents">
                <?php
                    foreach($details as $riderDetails){
                        echo "<img src='$riderDetails->rider_img' alt='profile pic'>";
                        echo "<h3>$riderDetails->rider_username</h3>";
                    }
                ?>
                <a href="index.php?command=editProfile" class="btn">Edit Profile</a>
            </div>
        </div>
    </section>
</body>
</html>