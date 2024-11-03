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
            <form method="POST" id = "customerForm">
                <input type="text" placeholder="Username" name="user" class = "customerTxt" autocomplete="off" required>
                <input type="password" placeholder="Password" name="pass" class = "customerTxt" autocomplete="off" required>
                <input type="text" placeholder="Location" name="loc" class = "customerTxt" autocomplete="off" required>
                <input type="text" placeholder="Contact" name="contact" class = "customerTxt" autocomplete="off" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
        
        <div id = "storeRegister">
            <form method="POST">
                    
            </form>
        </div>
    </div>

    <script src="js/index.js"></script>
</body>
</html>