<?php
include 'db.php'; // Database connection

// Manually include PHPMailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Kolkata'); // Set your timezone

// Fetch today's tasks with start time matching the current time
$currentDate = date('Y-m-d');
$currentTime = date('H:i');

$sql = "SELECT subject, tasks, start_time, email FROM tasks WHERE DATE(start_time) = ? AND TIME(start_time) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $currentDate, $currentTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subject = $row['subject'];
        $task = $row['tasks'];
        $startTime = date('h:i A', strtotime($row['start_time']));
        $email = $row['email'];

        // Send email reminder using PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'studyplannerskilled@gmail.com'; // Your email address
            $mail->Password = 'ttmk jrgz ufvu bqpu'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('studyplannerskilled@gmail.com', 'Study Planner');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Task Reminder: $subject";
            $mail->Body = "
                <h2>Reminder for Your Scheduled Task</h2>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Task:</strong> $task</p>
                <p><strong>Start Time:</strong> $startTime</p>
                <p>Don't miss out on your scheduled task. Stay productive!</p>
            ";

            $mail->send();
            echo "Reminder sent to $email for task '$task'.<br>";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo . "<br>";
        }
    }
} else {
    echo "No tasks scheduled for this time.";
}

$stmt->close();
$conn->close();
?>
