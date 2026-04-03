<?php
    // Input validation
    $username = isset($_POST['username']) ? $_POST['username']: '';
    $email = isset($_POST['email']) ? $_POST['email']: '';
    $password = isset($_POST['password']) ? $_POST['password']: '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password']: '';
    $role = isset($_POST['role']) ? $_POST['role']: '';

    // If the input is empty redirect to register page
    if(empty($username) || empty($email) || empty($password) || empty($role)) {
        header("refresh:2 ; URL= 'register.php'");
        echo "Invalid Input";
        exit;
    }

    // password check
    if($password != $confirm_password) {
        header("refresh:2 ; URL= 'register.php'");
        echo "password do not match";
        exit;
    }

    
    try {
        // DB check
        require_once "./db_config.php";

        // sql statement for exsist account 
        $exists_sql = "SELECT * FROM users WHERE username = '$username'";

        $exists_result = $db_conn->query($exists_sql);

        if($exists_result -> num_rows > 0){
            header("refresh:2 ; URL= 'register.php'");
            echo "This user name already have an account";
            exit;
        }

        // password hashing
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // sql statement for new account 
        $sql_insert = "INSERT INTO users(username, email, password, role)
                        VALUES ('$username', '$email', '$pass_hash', '$role')";

        $result = $db_conn->query($sql_insert);

        // if the result is invalid re-direct to the register page
        // else show the register message
        if(!$result){
            header("refresh: 2 ; URL= 'register.php'");
            echo "Fail to submit";
            exit;
        }else{
            header("refresh: 2 ; URL= 'login.php'");
            echo "Register Completed";
            exit;
        }


    }catch(Exception $e){
        // error message
        echo "DB Error".$e;
    }
    // DB Close
    $db_conn->close();


?>