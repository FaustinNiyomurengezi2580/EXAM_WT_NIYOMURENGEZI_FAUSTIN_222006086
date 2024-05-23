<?php
include('database_connection.php');

if (isset($_REQUEST['TaskID'])) {
    $TaskID = $_REQUEST['TaskID'];

    $stmt = $connection->prepare("DELETE FROM tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $TaskID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='tasks.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "TaskID is not set.";
}

$connection->close();
?>
