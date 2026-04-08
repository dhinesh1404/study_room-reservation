<?php
require_once "db_config.php";


// get data
$user_id = $_SESSION['user_id']?? '';
$room_id = $_POST['room_id'] ?? '';
$time_slot_id = $_POST['time_slot_id'] ?? '';
$date = $_POST['date'] ?? '';

// validation
if (empty($room_id) || empty($time_slot_id) || empty($date)) {
    echo "All fields are required!";
    exit;
}

// check if already booked
$check_sql = "
SELECT * FROM bookings 
WHERE room_id='$room_id' 
AND date='$date' 
AND time_slot_id='$time_slot_id'
AND status='booked'
";

$result = $db_conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "This time slot is already booked!";
    exit;
}

// insert booking
$insert_sql = "
INSERT INTO bookings (user_id, room_id, time_slot_id, date, status)
VALUES ('$user_id', '$room_id', '$time_slot_id', '$date', 'booked')
";

if ($db_conn->query($insert_sql)) {
    header("Location: my_booking.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>