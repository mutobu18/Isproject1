<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    

    // Hash the password for security
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_account (username, password, role)
            VALUES ('$username', '$hashed_pass', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful! You can now log in.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
