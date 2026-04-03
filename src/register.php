<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Sign Up</h2>

<form action="register_process.php" method="post">
    <fieldset>
    <!-- ROLE -->
    <label for="user">User Type :</label>
    <input type="radio" name="role" value="user" checked> User
    <input type="radio" name="role" value="admin"> Admin
    <br><br>

    <!-- USERNAME -->
    <label for="username">Username :</label>
    <input type="text" name="username" required>
    <br><br>

    <!-- EMAIL -->
    <label for="email">Email :</label>
    <input type="email" name="email" required>
    <br><br>

    <!-- PASSWORD -->
    <label for="password">Password :</label>
    <input type="password" name="password" required>

    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <br><br>

    <button>submit</button>
    <input type="reset" value="Reset">
</fieldset>
</form>
    <a href="login.php">Already have an account</a>

</body>
</html>