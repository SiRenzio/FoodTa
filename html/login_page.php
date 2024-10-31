<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $_SESSION["isLoggedIn"] = false;
        echo "<a class='order' href='index.php?command=order&LoggedIn=true'>Log In</a>";
    ?>
</body>
</html>