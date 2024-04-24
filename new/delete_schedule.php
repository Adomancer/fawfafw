<?php
// Include database configuration
require_once('config.php');

// Check if the event ID is set in the POST data
if(isset($_POST['id'])) {
    // Sanitize the event ID
    $eventId = $conn->real_escape_string($_POST['id']);

    // Perform the deletion query
    $deleteQuery = $conn->query("UPDATE `website_economics` SET `title` = NULL, `description` = NULL, `start_datetime` = NULL, `end_datetime` = NULL WHERE `id` = '$eventId'");

    if($deleteQuery) {
        // Deletion successful
        echo 'Event deleted successfully.';
    } else {
        // Deletion failed
        echo 'Failed to delete event.';
    }
} else {
    // Event ID not set
    echo 'Event ID not provided.';
}

// Close database connection
$conn->close();
?>
