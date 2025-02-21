<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'myDatabase');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch weekly tasks
$query = "SELECT task, day, TIMEDIFF(end_time, start_time) as duration, priority, goals, notes 
          FROM weekly_tasks 
          ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='task-item'>
                <strong>Day:</strong> {$row['day']}<br>
                <strong>Task:</strong> {$row['task']}<br>
                <strong>Duration:</strong> {$row['duration']}<br>
                <strong>Priority:</strong> {$row['priority']}<br>
                <strong>Goals:</strong> {$row['goals']}<br>
                <strong>Notes:</strong> {$row['notes']}<br>
                <hr>
              </div>";
    }
} else {
    echo '<div class="no-tasks">No tasks for this week</div>';
}

$conn->close();
?>
