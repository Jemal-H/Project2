<?php
session_start();

// Destroy all session data
session_destroy();

// Start new session
session_start();

// Redirect to home page
header("Location: ../index.php");
exit;
?>
