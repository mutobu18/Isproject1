<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_account WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // Redirect based on role
            if ($user['role'] == "Student_Resident") {
                header("Location: student.php");
            } elseif ($user['role'] == "Manager") {
                header("Location: manager.php");
            } elseif ($user['role'] == "Security") {
                header("Location: securityofficer.php");
            } elseif ($user['role'] == "Admin") {
                header("Location: admin.php");
            } else {
                echo "Unknown role!";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
