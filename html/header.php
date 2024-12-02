<?php
    if(!isset($_SESSION['logState'])){
        $_SESSION['logState'] = false;
    }
    if(!isset($_SESSION['account_type'])){
        $_SESSION['account_type'] = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-footer.css">
</head>
<body>
    <header>
        <nav class="Header">
            <img class="brand_logo" src="images/foodTaSectionLogo(White).png" alt="Deja Brew Logo">
            <div class="header_button">
                <a class="home" href="index.php?command=home">Home</a>
                <!-- <a class="order" href="index.php?command=order">Order</a> -->
                <?php
                    if($_SESSION['account_type'] == "store"){
                        echo "<a class='about' href='index.php?command=order'>Store</a>";
                    }
                    else{
                        echo "<a class='about' href='index.php?command=order'>Order</a>";
                    }

                    if($_SESSION['logState'] === false){
                        echo "<a class='about' href='index.php?command=order'>Store</a>";
                        echo "<a class='about' href='index.php?command=register'>Register</a>";
                    }
                    else{
                        echo "<a class='about' href='index.php?command=logout'>Logout</a>";
                    }
                ?>
            </div>
        </nav>
    </header>
</body>
</html>