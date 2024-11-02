<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <form action="index.php?command=order" method="post">
                <h1>Login</h1>
                <div class="input-field">
                    <input type="text" placeholder="Username" name="user" autocomplete="off" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" name="pass" autocomplete="off" required>
                </div>
                <button class="btn">Login</button>
                <div class="register">
                    <p>Don't have an account? <a href="#">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>