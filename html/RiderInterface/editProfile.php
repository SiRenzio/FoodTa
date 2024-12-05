<?php 
        $backLink = 'index.php?command=deliveryRider';
        $position = 'right';
        include 'backBTN.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editRiderProfile.css">
    <title>Edit Profile</title>
    <script type="text/javascript">
        function imagePreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("previewImage");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
</head>
<body>
    
    <div id="editProfile">
        <form action="index.php?command=updateProfile" method="POST" id="editForm" enctype="multipart/form-data">
            <h1 id="formHeader">Edit Profile</h1>

            <img src="<?php echo $details[0]->rider_img ?>" id="previewImage" alt="preview">
            
            <label for="fileToUpload" class="custom-file-button">Upload Profile Photo</label>
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)" accept="image/*">

            <label for="rider_user" class="userlabel">Username</label>
            <input type="text" placeholder="Username" name="rider_user" class="formTxt" value="<?php echo $details[0]->rider_username ?>" autocomplete="off" required>

            <input type="submit" value="Save" class="formBtn">
        </form>
    </div>
</body>
</html>
