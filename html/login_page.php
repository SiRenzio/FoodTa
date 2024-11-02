<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="index.php?command=order" method="post">
            <h1>Login</h1>
            <div class="input-field">
                <input type="text" placeholder="Username" name="user" required>
            </div>
            <div class="input-field">
                <input type="password" placeholder="Password" name="pass" required>
            </div>
            <button class="btn">Login</button>
        </form>
    </div>
</body>
</html>