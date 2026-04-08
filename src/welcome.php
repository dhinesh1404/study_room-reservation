<?php
    // session start
    session_start();

    // create a session variable
    $session_name = $_SESSION['username'] ?? '';

    $session_role = $_SESSION['role'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class= "username">
        welcome, <?= $session_name ?>
        <a href="logout.php">Logout</a>
    </div>
    
</body>
</html>