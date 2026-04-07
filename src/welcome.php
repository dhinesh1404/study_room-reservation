<?php
    // session start
    session_start();

    // create a session variable
    $session_name = $_SESSION['username'];

    $roles = ["user", "admin"];

    $session_role = $_SESSION['role']

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class= "username">
        welcome, <?php= "$session_name" ?>
        <a href="logout.php">Logout</a>
    </div>
    
</body>
</html>