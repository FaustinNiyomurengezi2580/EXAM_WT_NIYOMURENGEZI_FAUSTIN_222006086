<?php
include('database_connection.php');

if (isset($_REQUEST['RecipientUserID'])) {
    $RecipientUserID = $_REQUEST['RecipientUserID'];

    $stmt = $connection->prepare("DELETE FROM notifications WHERE RecipientUserID = ");
    $stmt->bind_param("i", $RecipientUserID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='notifications.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "RecipientUserID is not set.";
}

$connection->close();
?>
