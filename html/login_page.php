<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="logInPage">
            <div class="wrapper">
                <form action="index.php?command=login" method="post">
                    <h1>Login</h1>
                    <div class="input-field">
                        <input type="text" placeholder="Username" name="user" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="Password" name="pass" autocomplete="off" required>
                    </div>
                    <button class="btn">Login</button>
                    <div class="register">
                        <p>Don't have an account? <a href="index.php?command=register">Register</a></p>
                    </div>
                </form>
            </div>
    </section>
</body>
</html>