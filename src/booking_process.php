<?php
session_start();

    // set the time zone 
    date_default_timezone_set('Asia/Seoul');

    // get data
    $room_id = isset($_POST['room_id'])? $_POST['room_id']: '';
    $time_slot_id = isset($_POST['time_slot_id'])? $_POST['time_slot_id']: '';
    $date = isset($_POST['date'])? $_POST['date']: '';

    
    // date format
    $date = date("Y-m-d", strtotime($date));

    // validation
    if(empty($room_id) || empty($time_slot_id) || empty($date)) {
        header("refresh: 2; URL= 'room.php?id=$room_id'");
        echo "All Fields are required";
        exit;

    }

    try{

        // DB Connect
        require_once "./db_config.php";

        // get the current time 
        $current_time = time();

        // get the slot end time 
        $slot = "SELECT end_time FROM time_slots WHERE id='$time_slot_id'";
        $slot_result = $db_conn->query($slot);
        $slot_exec = $slot_result->fetch_assoc();

        $slot_datetime = $date . ' ' . $slot_exec['end_time'];

        // convert to time stamp
        $slot_time = strtotime($slot_datetime);

        // Block the past time and date 
        if($slot_time < $current_time) {
            header ("refresh: 2 ; URL=room.php?id=$room_id&date=$date");
            echo "Sorry, you can only book current or future time slots.";
            exit;
        }


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
            echo "This time slot is already booked!";
            exit;

        }

        // new booking sql statement
        $insert_sql = "INSERT INTO bookings (user_id, room_id, time_slot_id, date, status)
                        VALUES ('{$_SESSION['id']}', '$room_id', '$time_slot_id', '$date', 'booked')";

        // Execute query
        $result_inst = $db_conn->query($insert_sql);

        // Execute result
        if(!$result_inst) {
            header("refresh: 2; URL= 'room.php'");
            echo "Booking failed";
            exit;
        }else{
            header("refresh: 2; URL=dashboard.php");
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