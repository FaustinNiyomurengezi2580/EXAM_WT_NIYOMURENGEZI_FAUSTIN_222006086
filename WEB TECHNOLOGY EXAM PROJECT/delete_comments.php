<?php
include('database_connection.php');

if (isset($_REQUEST['CommentID'])) {
    $CommentID = $_REQUEST['CommentID'];

    $stmt = $connection->prepare("DELETE FROM comments WHERE CommentID = ?");
    $stmt->bind_param("i", $CommentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>";
        echo "<a href='comments.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "CommentID is not set.";
}

$connection->close();
?>
