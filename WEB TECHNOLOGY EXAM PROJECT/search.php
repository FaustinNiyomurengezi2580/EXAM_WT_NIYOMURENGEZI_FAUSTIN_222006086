<?php
include('database_connection.php');

if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Search in the workshops table
    $sql = "SELECT * FROM workshops WHERE workshop_id LIKE '%$searchTerm%'";
    $result_workshop = $connection->query($sql);

    // Search in the notifications table
    $sql = "SELECT * FROM notifications WHERE notification_id LIKE '%$searchTerm%'";
    $result_notification = $connection->query($sql);

    // Search in the resources table
    $sql = "SELECT * FROM resources WHERE resource_id LIKE '%$searchTerm%'";
    $result_resource = $connection->query($sql);

    // Search in the materials table
    $sql = "SELECT * FROM materials WHERE material_id LIKE '%$searchTerm%'";
    $result_material_id = $connection->query($sql);

    // Search in the instructors table
    $sql = "SELECT * FROM instructors WHERE instructor_id LIKE '%$searchTerm%'";
    $result_instructor = $connection->query($sql);

    // Search in the feedback table
    $sql = "SELECT * FROM feedback WHERE feedback_id LIKE '%$searchTerm%'";
    $result_feedback = $connection->query($sql);

    // Search in the enrollment table
    $sql = "SELECT * FROM enrollment WHERE enrollment_id LIKE '%$searchTerm%'";
    $result_enrollment = $connection->query($sql);

    // Search in the attendees table
    $sql = "SELECT * FROM attendees WHERE attendee_id LIKE '%$searchTerm%'";
    $result_attendee = $connection->query($sql);

    // Search in the payments table
    $sql = "SELECT * FROM payments WHERE payment_id LIKE '%$searchTerm%'";
    $result_payment = $connection->query($sql);


    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>notifications:</h3>";
    if ($result_notification->num_rows > 0) {
        while ($row = $result_notification->fetch_assoc()) {
            echo "<p>" . $row['notification_id'] . "</p>";
        }
    } else {
        echo "<p>No notifications found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>workshops:</h3>";
    if ($result_workshop->num_rows > 0) {
        while ($row = $result_workshop->fetch_assoc()) {
            echo "<p>" . $row['workshop_id'] . "</p>";
        }
    } else {
        echo "<p>No workshops found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>resources:</h3>";
    if ($result_resource->num_rows > 0) {
        while ($row = $result_resource->fetch_assoc()) {
            echo "<p>" . $row['resource_id'] . "</p>";
        }
    } else {
        echo "<p>No resources found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>materials:</h3>";
    if ($result_material_id->num_rows > 0) {
        while ($row = $result_material_id->fetch_assoc()) {
            echo "<p>" . $row['material_id'] . "</p>";
        }
    } else {
        echo "<p>No materials found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>instructors:</h3>";
    if ($result_instructor->num_rows > 0) {
        while ($row = $result_instructor->fetch_assoc()) {
            echo "<p>" . $row['instructor_id'] . "</p>";
        }
    } else {
        echo "<p>No instructors found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>feedback:</h3>";
    if ($result_feedback ->num_rows > 0) {
        while ($row = $result_feedback ->fetch_assoc()) {
            echo "<p>" . $row['feedback_id'] . "</p>";
        }
    } else {
        echo "<p>No feedback found matching the search term: " . $searchTerm . "</p>";
    }
 echo "<h3>enrolment:</h3>";
    if ($result_enrollment->num_rows > 0) {
        while ($row = $result_enrollment->fetch_assoc()) {
            echo "<p>" . $row['enrollment_id'] . "</p>";
        }
    } else {
        echo "<p>No enrolment found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>attendees:</h3>";
    if ($result_attendee->num_rows > 0) {
        while ($row = $result_attendee->fetch_assoc()) {
            echo "<p>" . $row['attendee_id'] . "</p>";
        }
    } else {
        echo "<p>No attendees found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>payments:</h3>";
    if ($result_payment->num_rows > 0) {
        while ($row = $result_payment->fetch_assoc()) {
            echo "<p>" . $row['payment_id'] . "</p>";
        }
    } else {
        echo "<p>No payments found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
