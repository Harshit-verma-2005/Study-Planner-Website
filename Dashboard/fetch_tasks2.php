<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'myDatabase');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch today's tasks
$query = "SELECT subject, tasks, TIMEDIFF(end_time, start_time) as duration, priority, notes FROM tasks WHERE DATE(start_time) = CURDATE()";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='task-item'>
                <strong>Subject:</strong> {$row['subject']}<br>
                <strong>Task:</strong> {$row['tasks']}<br>
                <strong>Duration:</strong> {$row['duration']}<br>
                <strong>Priority:</strong> {$row['priority']}<br>
                <strong>Notes:</strong> {$row['notes']}<br>
                <hr>
              </div>";
    }
} else {
    echo '<div class="no-tasks">No tasks for today</div>';
}

$conn->close();
?>
