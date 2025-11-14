<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM user_account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {

            // Save session
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // Redirect based on role
            switch ($user['role']) {
                case "Student_Resident":
                    header("Location: student.php");
                    exit();
                case "Manager":
                    header("Location: manager.php");
                    exit();
                case "Security":
                    header("Location: securityofficer.php");
                    exit();
                case "Admin":
                    header("Location: admin.php");
                    exit();
                default:
                    echo "Unknown role!";
                    exit();
            }

        } else {
            echo "Invalid password.";
        }

    } else {
        echo "User not found.";
    }
}
?>
