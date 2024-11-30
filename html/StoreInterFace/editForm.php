<?php include('html/StoreInterface/sideBar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Books</title>
    <link rel="stylesheet" href="css/edit.css">
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
    <section class="editPage">
        <form action='index.php?command=updateItems&item_id=<?php echo $items[0]->item_id ?>' method='post' enctype='multipart/form-data' class="edit-form">
            <h2>Edit Coffee Details</h2>
            
            <label for="item_name">Coffee Name:</label>
            <input type='text' name='item_name' id="item_name" value='<?php echo $items[0]->item_name ?>'>
            
            <div class="image-preview-section">
                <h3>Please upload coffee photo:</h3>
                <img src='<?php echo $items[0]->item_img ?>' id="previewImage" alt='Coffee Image' class="preview-image">
            </div>
            
            <label for="fileToUpload" class="custom-file-button">Upload Cover Page</label>
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)" accept="image/*">

            <label for="quantity">Quantity:</label>
            <input type='text' name='quantity' id="quantity" value='<?php echo $items[0]->quantity ?>'>

            <label for="price">Price:</label>
            <input type='text' name='price' id="price" value='<?php echo $items[0]->price ?>'>

            <label for="category">Category:</label>
            <input type='text' name='category' id="category" value='<?php echo $items[0]->category ?>'>        
            
            <div class="form-buttons">
                <input type='submit' value='Update Records' name='saveRecords'>
                <input type='reset' value='Reset'>
            </div>
        </form>
    </section>
</body>
</html>
