<?php
include('database_connection.php');

if (isset($_REQUEST['AssignmentID'])) {
    $AssignmentID = $_REQUEST['AssignmentID'];

    $stmt = $connection->prepare("DELETE FROM assignments WHERE AssignmentID = ?");
    $stmt->bind_param("i", $AssignmentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='assignments.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "AssignmentID is not set.";
}

$connection->close();
?>
