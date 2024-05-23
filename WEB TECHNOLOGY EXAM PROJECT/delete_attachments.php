<?php
include('database_connection.php');

if (isset($_REQUEST['AttachmentID'])) {
    $AttachmentID = $_REQUEST['AttachmentID'];

    $stmt = $connection->prepare("DELETE FROM attachments WHERE AttachmentID = ?");
    $stmt->bind_param("i", $AttachmentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='users.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "AttachmentID is not set.";
}

$connection->close();
?>
