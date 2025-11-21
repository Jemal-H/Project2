<?php
session_start();

// Deletes all session data
session_destroy();

// Start new session
session_start();

// Sends back to home page
header("Location: ../index.php");
exit;
?>
