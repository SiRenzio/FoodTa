<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <div id = "container" style="margin-top: 4em;">
        <?php
        echo "<a href='index.php?command=payment&subTotal=".$_SESSION['subTotal']."&revertStatus=true'>Back</a>";
            foreach($drivers as $dr){
                echo "Driver Name: " . $dr->full_name;
                echo "Vehicle: " . $dr->vehicle_name;
                echo "Plate No.: " . $dr->vehicle_plate;
                echo "<img src='" . $dr->rider_img ."'>";
                echo "<input type = 'submit' value = 'Select Rider'>";
            }
        ?>
    </div>
</body>
</html>