<?php
    require_once "./welcome.php";

    $user_id = $_SESSION['id'];


try {

    require_once "./db_config.php";

    // get user data
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = $db_conn->query($sql);

    if (!$result || $result->num_rows == 0) {
        throw new Exception("User not found");
    }

    $user = $result->fetch_assoc();

} catch (Exception $e) {
    echo "Error: " . $e;
    exit;
}

$db_conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

<h2>My Profile</h2>

<!-- USER INFO -->
<p><strong>Name:</strong> <?php echo $user['username']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<hr>

<!-- UPDATE PROFILE -->
<h3>Update Profile</h3>

<form action="update_profile.php" method="post">

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

    <label>Current Password:</label><br>
    <input type="password" name="current_password" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password"><br><br>

    <button type="submit">Update</button>
</form>

<hr>

<!-- DELETE ACCOUNT -->
<h3>Delete Account</h3>

<form action="delete_account.php" method="post"
      onsubmit="return confirm('Are you sure? This will delete your account permanently!');">

    <button type="submit">Delete Account</button>

</form>
</body>
</html>