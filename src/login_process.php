<?php
    // validate the user input
    $role = isset($_POST['role']) ? $_POST['role']: '';
    $username = isset($_POST['username']) ? $_POST['username']: '';
    $password = isset($_POST['password']) ? $_POST['password']: '';

    // if the input is wrong diaplan a error message
    if(empty($role) || empty($username) || empty($password)){
        header ("refresh:2 ; URL= 'login.php'");
        echo "Enter your username and password";
        exit;
    }
    
    try{
        // connect the db
        require_once "./db_config.php";

        // sql statement
        $sql = "SELECT * FROM users WHERE username = '$username'";

        // sql query
        $result = $db_conn->query($sql);

        // if the result is invalid display a error message
        // else redirect to the main page
        // Or next to the login start the session 
        // password verify

        if(!$result){
            header ("refresh: 2 ; URL= 'login.php'");
            echo "Invalid Input";
            exit;
        }

        $row = $result->fetch_assoc();
        
        // check the user exists
        if(!$row) {
            header ("refresh: 2 ; URL= 'login.php'");
            echo "User not found";
            exit;
        }

        // Check password
        if(!password_verify($password, $row['password'])){
            header ("refresh: 2 ; URL= 'login.php");
            echo "Incorrect password";
            exit;
        }

        // check the role 
        if($row['role'] != $role) {
            header ("refresh: 2 ; URL= 'login.php'");
            echo "Invalid role selected";
            exit;
        }

        // set session
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header ("URL= 'dashboard.php'");
        echo "Login successful";
        exit;

    }catch(Exception $e){
        // DB error message
        echo "DB Error" .$e;
    }
    
    // DB CLOSE
    $db_conn->close();

?>