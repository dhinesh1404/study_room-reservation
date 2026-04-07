<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>welcome, <?php echo $_SESSION['username']; ?> </h2>

    <hr>

    <ul>
        <li><a href="booking.php"> Book Room</a></li>
        <li><a href="my_booking.php"> My Booking</a></li>
        <li><a href="profile.php"> profile</a></li>
    </ul>
    
</body>
</html>