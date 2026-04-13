<?php

$room_id = isset($_GET['id'])? $_GET['id']: '';

// validate the room_id
if(empty($room_id)) {
    header("refresh: 2; URL= 'dashboard.php'");
    echo "Invalid Room";
    exit;
}

try{
    // DB connect 
    require_once "./db_config.php";

    // get room details
    $result = $db_conn->query("SELECT * FROM rooms WHERE id='$room_id'");

    if($result->num_rows == 0) {
        echo "Room not found";
        exit;
    }

    $room = $result->fetch_assoc();

    // selected date (default today)
    $date = $_GET['date'] ?? date('Y-m-d');
        
    // get all slots
    $slots = $db_conn->query("SELECT * FROM time_slots");

    // get booked slots for that room + date
    $booked = $db_conn->query("
        SELECT time_slot_id FROM bookings 
        WHERE room_id='$room_id' AND date='$date'
    ");
    $booked_slots = [];
    while ($b = $booked->fetch_assoc()) {
        $booked_slots[] = $b['time_slot_id'];
    }
    
    
    }catch (Exception $e){
        // DB error message
        echo "DB Error" .$e;
    }
    // DB close
    $db_conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Room</title>
</head>
<body>

<h2><?php echo $room['room_name']; ?></h2>
<p>Capacity: <?php echo $room['capacity']; ?></p>
<p>Location: <?php echo $room['location']; ?></p>

<hr>

<!-- DATE SELECT -->
<form method="get">
    <input type="hidden" name="id" value="<?php echo $room_id; ?>">
    
    <label>Select Date:</label>
    <input type="date" name="date" value="<?php echo $date; ?>" required>

    <button type="submit">Check</button>
</form>

<hr>

<!-- BOOKING FORM -->
<form action="booking_process.php" method="post">

    <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
    <input type="hidden" name="date" value="<?php echo $date; ?>">

    <h3>Available Time Slots</h3>

    <?php
    while ($slot = $slots->fetch_assoc()) {

        $isBooked = in_array($slot['id'], $booked_slots);
    ?>

        <div>
            <input type="radio" name="time_slot_id"
                value="<?php echo $slot['id']; ?>"
                <?php echo $isBooked ? 'disabled' : ''; ?> required>

            <?php echo $slot['start_time'] . " - " . $slot['end_time']; ?>

            <?php if ($isBooked) echo "(Booked)"; ?>
        </div>

    <?php } ?>

    <br>
    <button type="submit">Book Now</button>

</form>

</body>
</html>