<?php
    // DB config
    $hostname = 'db';
    $usrname = 'root';
    $pass_wrd = 'root';
    $database = 'study_room_booking';

    // db connect
    $db_conn = new mysqli($hostname, $usrname, $pass_wrd, $database);

?>