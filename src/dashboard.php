<?php
require_once "db_config.php";
require_once "./welcome.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<!-- TOP SECTION -->

<hr>

<!-- ROOMS -->
<h3>Available Rooms</h3>

<?php
$rooms = $db_conn->query("SELECT * FROM rooms WHERE status='available'");

while ($room = $rooms->fetch_assoc()) {
?>
    <div>
        <h4><?php echo $room['room_name']; ?></h4>
        <p>Capacity: <?php echo $room['capacity']; ?></p>
        <p>Location: <?php echo $room['location']; ?></p>

        <a href="room.php?id=<?php echo $room['id']; ?>">Enter Room</a>
    </div>
    <hr>
<?php } ?>

</body>
</html>