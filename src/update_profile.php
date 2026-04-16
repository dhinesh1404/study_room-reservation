<?php
    session_start();

    $user_id = $_SESSION['id'];

try {

    require_once "./db_config.php";


    // get form data
    $email = $_POST['email'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    // validation
    if (empty($email) || empty($current_password)) {
        throw new Exception("All required fields must be filled");
    }

    // get user from DB
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = $db_conn->query($sql);

    if (!$result || $result->num_rows == 0) {
        throw new Exception("User not found");
    }

    $user = $result->fetch_assoc();

    // verify current password
    if (!password_verify($current_password, $user['password'])) {
        throw new Exception("Incorrect current password");
    }

    // prepare update query
    $update_sql = "UPDATE users SET email='$email'";

    // update password only if new password is given
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql .= ", password='$hashed_password'";
    }

    $update_sql .= " WHERE id='$user_id'";

    // execute update
    if (!$db_conn->query($update_sql)) {
        throw new Exception("Failed to update profile");
    }

    // success
    header("refresh:2; URL=profile.php");
    echo "Profile updated successfully";

} catch (Exception $e) {
    echo "Error: " . $e;
}

$db_conn->close();
?>