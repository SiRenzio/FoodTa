<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register_page.css">
    <title>Food Ta! Delivery</title>
    <script type="text/javascript">
    	function imagePreview(event) {
        	if(event.target.files.length > 0)
        	{
        		var src = URL.createObjectURL(event.target.files[0]);
            	var preview = document.getElementById("previewImage");
            	preview.src = src;      
            	preview.style.display = "block";
        	}
    	}	
        function imagePreview2(event) {
        	if(event.target.files.length > 0)
        	{
        		var src = URL.createObjectURL(event.target.files[0]);
            	var preview2 = document.getElementById("previewImage2");
            	preview2.src = src;      
            	preview2.style.display = "block";
        	}
    	}	
    </script>
</head>
<body>
    
    <div id="selection">
        <img class="ftSecLogo" src="images/foodTaSectionLogo(Green).png" alt="Food Ta Logo">
        <h2 class="brandline">Welcome To Food Ta! Delivery</h2>
        <p class="tagline">Be One of Us.</p>
        <div id="buttonContainer">
            <button id="customerBtn" onclick="displayCustomerForm()">
                <img src="images/customer.png" alt="Order Food" class="btnImg">Order food!
            </button>
            <button id="storeBtn" onclick="displayStoreForm()">
                <img src="images/sell.png" alt="Sell Food" class="btnImg">Sell food!
            </button>
            <button id="deliveryBtn" onclick="displayDeliveryForm()">
                <img src="images/sell.png" alt="Deliver Food" class="btnImg">Deliver food!
            </button>
        </div>
        <div id="customerRegister">
            <form action="index.php?command=checkRegister&&accType=customer" method="POST" id="customerForm">
                <h1 id="formHeader">Ready to order food?</h1>

                <input type="text" placeholder="Full Name" name="fullname" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Username" name="user" class="formTxt" autocomplete="off" required>
                <input type="password" placeholder="Password" name="pass" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Location" name="loc" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Contact No." name="contact" class="formTxt" autocomplete="off" required>

                <input type="submit" value="Sign up" class="formBtn">
                <button type="button" class="backBtn" onclick="goBack()">Back</button>
            </form>
        </div>
        
        <div id="storeRegister">
            <form action="index.php?command=checkRegister&&accType=store" method="POST" id="storeForm" enctype='multipart/form-data'>
                <h1 id="formHeader">Ready to sell food?</h1>

                <input type="text" placeholder="Store Name" name="storename" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Username" name="store_user" class="formTxt" autocomplete="off" required>
                <input type="password" placeholder="Password" name="store_pass" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Location" name="store_loc" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Description" name="desc" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Rating" name="rating" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Opening Hour (Ex. Format: 00:00:00)" name="opening_hr" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Closing Hour (Ex. Format: 00:00:00)" name="closing_hr" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Contact No." name="store_contact" class="formTxt" autocomplete="off" required>
                <img src="images/preview.png" id="previewImage" alt="preview" width="300" height="300">
                <label for="fileToUpload" class="custom-file-button">Upload Store Image</label>
				<input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview(event)" accept="image/*"></input>
                
                <input type="submit" value="Sign up" class="formBtn">
                <button type="button" id="backBtn" class="backBtn" onclick="goBack()">Back</button>
            </form>
        </div>
        <div id="deliveryRegister">
            <form action="index.php?command=checkRegister&&accType=delivery" method="POST" id="deliveryForm" enctype='multipart/form-data'>
                <h1 id="formHeader">Ready to deliver food?</h1>
                
                <input type="text" placeholder="Full Name" name="ridername" class="formTxt" autocomplete="off" required>
                <input type="number" placeholder="Contact Number" name="rider_contact" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Vehicle Plate" name="riderplate" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Vehicle Name" name="ridervehicle" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Status" name="riderstatus" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Username" name="rider_username" class="formTxt" autocomplete="off" required>
                <input type="text" placeholder="Password" name="rider_password" class="formTxt" autocomplete="off" required>
                <img src="images/preview.png" id="previewImage2" alt="preview" width="300" height="300">
                <label for="fileToUpload" class="custom-file-button">Upload Store Image</label>
				<input type="file" name="fileToUpload" id="fileToUpload" onchange="imagePreview2(event)" accept="image/*"></input>

                <input type="submit" value="Sign up" class="formBtn">
                <button type="button" id="backBtn" class="backBtn" onclick="goBack()">Back</button>
            </form>
        </div>
    </div>  
    <script src="js/index.js"></script>
</body>
</html>
