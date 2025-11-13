<?php
include 'db.php'; // connect to database

if(isset($_POST['visitorName'])) {
    // Get form data
    $visitor_name = $_POST['visitorName'];
    $visitor_phone = $_POST['visitorPhone'];
    $visitor_id = $_POST['visitorID'];
    $visit_date = $_POST['visitDate'];
    $visit_time = $_POST['visitTime'];
    $visit_reason = $_POST['visitReason'];
    
    $status = 'pending'; // default status

    // Insert into visit_log table
    $sql = "INSERT INTO visit_log (visitorName, visitorPhone, visitorID, visitDate, visitTime, visitReason, status)
            VALUES ('$visitor_name', '$visitor_phone', '$visitor_id', '$visit_date', '$visit_time', '$visit_reason', '$status')";

    if($conn->query($sql) === TRUE) {
        echo "Request submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
