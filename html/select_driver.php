<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/select_driver.css">
    <title>Driver Confirmation</title>
</head>
<body>
    <section class="waitingPage">
        <div class="container">
            <div class="confirmationDisplay">
                <?php 
                    if ($status == 1) {
                        echo "<div class='gifIcon fadeIn'>";
                            echo "<img class='gifAnimation' src='images/waiting.gif' alt='Waiting...'>";
                        echo "</div>";
                        echo "<h2>Waiting for Driver Confirmation...</h2>";
                    } else if ($status == 0) {
                        echo "<div class='gifIcon fadeIn'>";
                            echo "<img class='gifAnimation' src='images/accepted.gif' alt='Order Accepted'>";
                        echo "</div>";
                        echo "<h2>Order Accepted!</h2>";
                        echo "<script>
                                setTimeout(function() {
                                    window.location.href = 'nextPage.php'; 
                                }, 3000);
                            </script>";
                    }
                ?>
            </div>
        </div>
    </section>
</body>
</html>
