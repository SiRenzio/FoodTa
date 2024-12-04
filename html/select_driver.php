<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <div id = "container" style="margin-top: 4em;">
    <?php
        if ($status == 1){
            echo "Driver Selected! Waiting for driver confirmation...";
        } else {
            echo "Error on selecting driver, Please try again.";
        }
    ?>
    </div>
</body>
</html>