<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/findDrivers.css">
    <title>Select Drivers</title>
</head>
<body>
    <section class="foodTaRiders">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h1 class="riderHeader">Select Drivers</h1>

        <div class="driverProfiles">
            <?php
            foreach($drivers as $dr){
                echo "<div class='driverCard'>";
                    echo "<div class='profilePic'>";
                        echo "<img src='" . htmlspecialchars($dr->rider_img) . "' alt='" . htmlspecialchars($dr->full_name) . "'>";
                    echo "</div>";
                    echo "<div class='riderDetails'>";
                        echo "<div class='drName details'>Name: " . htmlspecialchars($dr->full_name) . "</div>";
                        echo "<div class='drVehicle details'>Vehicle: " . htmlspecialchars($dr->vehicle_name) . "</div>";
                        echo "<div class='drPlate details'>Plate Number: " . htmlspecialchars($dr->vehicle_plate) . "</div>";
                        echo "<div class='drContact details'>Contact #: " . htmlspecialchars($dr->contact_no) . "</div>";
                    echo "</div>";
                    echo "<div class='selectBtn'>";
                        echo "<input type='submit' value='Select Rider'>";
                    echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
</body>
</html>
