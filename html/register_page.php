<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register_page.css">
</head>
<body>
    <div id = "selection">
        <button id = "customerBtn" onclick="displayCustomerForm()">Order food!</button>
        <button id = "storeBtn" onclick="displayStoreForm()">Sell food!</button>

        <div id = "customerRegister">
            <form action = 'index.php?command=checkRegister&&accType=customer' method = "POST" id = "customerForm">
                <h1 id = "formHeader">Ready to order food?</h1>

                <input type="text" placeholder="Full Name" name="fullname" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Username" name="user" class = "formTxt" autocomplete="off" required>
                <input type="password" placeholder="Password" name="pass" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Location" name="loc" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Contact No." name="contact" class = "formTxt" autocomplete="off" required>

                <input type="submit" value = "Sign up" class = "formBtn">
            </form>
        </div>
        
        <div id = "storeRegister">
            <form action = 'index.php?command=checkRegister&&accType=store' method = "POST" id = "storeForm">
                <h1 id = "formHeader">Ready to sell food?</h1>

                <input type="text" placeholder="Full Name" name="fullname" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Store Name" name="storename" class = "formTxt" autocomplete="off" required>
                <input type="password" placeholder="Password" name="pass" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Location" name="loc" class = "formTxt" autocomplete="off" required>
                <input type="text" placeholder="Contact No." name="contact" class = "formTxt" autocomplete="off" required>
                
                <input type="submit" value = "Sign up" class = "formBtn">
            </form>
        </div>
    </div>  
    <script src ='js/index.js'></script>
</body>
</html>