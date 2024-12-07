<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "mydatabase"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Use isset() to check if values exist
    $goals = isset($_POST['goals']) ? $_POST['goals'] : '';
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';
    $task = isset($_POST['task']) ? $_POST['task'] : '';
    $day = isset($_POST['day']) ? $_POST['day'] : '';
    $start_time = isset($_POST['start-time']) ? $_POST['start-time'] : '';
    $end_time = isset($_POST['end-time']) ? $_POST['end-time'] : '';
    $priority = isset($_POST['priority']) ? $_POST['priority'] : '';

    // Insert data into the tasks table
    $sql = "INSERT INTO weekly_tasks (task, day, start_time, end_time, priority, goals, notes)
            VALUES ('$task', '$day', '$start_time', '$end_time', '$priority', '$goals', '$notes')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

echo "<script>alert('Task Added'); window.history.back();</script>";
// alert("Task Added");

header("Location: ../index.html");
?>
