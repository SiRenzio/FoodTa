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
                echo 'Customer Name: ' . $d->full_name . '<br>';
                echo 'Location: ' . $d->customer_address . '<br>';
            }
            echo 'Payment: ' . $_SESSION['subTotal'] . '<br>';
            echo ' <form action="index.php?command=itemDelivered&t_id=' . $d->transaction_id . '" method="post">';
            echo '<input type="submit" value="Complete Order">';
            echo '</form>';
        ?>
    </section>
</body>
</html>