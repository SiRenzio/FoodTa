<?php include('html/StoreInterface/sideBar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coffee</title>
    <link rel="stylesheet" href="css/addProducts.css">
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
    <section class="addingPage">
        <form action="index.php?command=addItems" method="post" enctype="multipart/form-data" class="form-container">
            <h2>Add New Products</h2>
            
            <label for="Name">Product Name:</label>
            <input type="text" name="item_name" id="Name">
            
            <p class="form-subheading">Please upload a product picture</p>
            <div class="image-preview">
                <img src="uploads/preview.png" id="previewImage" alt="Preview" width="336px" height="436px">
            </div>
            
            <label for="fileToUpload" class="custom-file-button">Upload Photo</label>
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)" accept="image/*">
            
            <label for="Quantity">Quantity:</label>
            <input type="number" name="Quantity" id="Quantity">

            <label for="Price">Price:</label>
            <input type="number" name="Price" id="Price">

            <label for="Category">Category:</label>
            <input type="text" name="Category" id="Category">
          
            <div class="button-group">
                <button type="submit" name="saveRecords" class="submit-button">Save Records</button>
                <button type="reset" class="reset-button">Reset</button>
            </div>
        </form>
    </section>
</body>
</html>

