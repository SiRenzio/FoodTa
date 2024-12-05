<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTW</title>
    <style>
        .container {
            position: absolute;
            top: 80px;
        }
    </style>
</head>
<body>
    <section class="container">
        <?php
            foreach($details as $d){
                echo 'Customer Name: ' . $d->customer_name . '<br>';
                echo 'Location: ' . $d->customer_address . '<br>';
                echo 'Payment: ' . $_SESSION['subTotal'] . '<br>';
            }
        ?>
        <form action="index.php?command=itemDelivered" method="post">
            <input type="submit" value="Submit">
        </form>
    </section>
</body>
</html>