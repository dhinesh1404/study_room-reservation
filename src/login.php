<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login_process.php" method= 'POST'>
        <fieldset>
            <h2>GSC Study Room</h2>
            <label for="user"> User :</label>
            <input type="radio" id="user" name="role" value="user">
            <label for="admin">Admin :</label>
            <input type="radio" id= "admin" name="role" value="admin">

            <hr>

            <input type="text" name="username" placeholder="Enter your username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>

            <button>Login</button>

            <a href="register.php">sign up</a>

        </fieldset>
    </form>
</body>
</html>