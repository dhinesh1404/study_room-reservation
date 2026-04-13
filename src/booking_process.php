<?php
    // get data
    $user_id = isset($_POST['user_id'])? $_POST['user_id']: '';
    $room_id = isset($_POST['room_id'])? $_POST['room_id']: '';
    $time_slot_id = isset($_POST['time_slot_id'])? $_POST['time_slot_id']: '';
    $date = isset($_POST['date'])? $_POST['date']: '';

    // validation
    if(empty($user_id) || empty($room_id) || empty($time_slot_id) || empty($date)) {
        header("refresh: 2; URL= 'room.php'");
        echo "All Fields are required";
        exit;

    }
    try{

        // DB Connect
        require_once "./db_config.php";

        // check the booking exists booking
        $check_sql = "SELECT * FROM bookings 
                        WHERE room_id='$room_id'
                        AND date='$date'
                        AND time_slot_id='$time_slot_id'
                        AND status='booked'
                        ";

        $result = $db_conn->query($check_sql);

        if($result->num_rows > 0) {
            header("refresh:2 ; URL='room.php'");
            echo "This time slot is alredy booked!";
            exit;

        }

        // new booking sql statement
        $insert_sql = "INSERT INTO bookings (user_id, room_id, time_slot_id, date, status)
                        VALUES ('$user_id', '$room_id', '$time_slot_id', '$date', 'booked')";

        // Execute query
        $result_inst = $db_conn->query($insert_sql);

        // Execute result
        if(!$result_inst) {
            header("refresh: 2; URL= 'room.php'");
            echo "Booking failed";
            exit;
        }else{
            header("refresh: 2; URL='dashboard.php");
            echo "Booking confirmed";
            exit;
        }

    }catch(Exception $e){
        // db error message
        echo "DB Error" .$e;
    }
    // DB close
    $db_conn->close();




?>