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
        echo "<tr>
                <td>{$row['subject']}<br></td>
                <td>{$row['tasks']}<br></td>
                <td>{$row['duration']}<br></td>
                <td class='warning'>Pending<br></td>
                <td class='primary'><a href='#'>Details</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No tasks for today</td></tr>";
}

$conn->close();
?>
