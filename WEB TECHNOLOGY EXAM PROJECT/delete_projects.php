<?php
include('database_connection.php');

if (isset($_REQUEST['ProjectID'])) {
    $ProjectID = $_REQUEST['ProjectID'];

    $stmt = $connection->prepare("DELETE FROM projects WHERE ProjectID = ?");
    $stmt->bind_param("i", $ProjectID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='tasks.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ProjectID is not set.";
}

$connection->close();
?>
