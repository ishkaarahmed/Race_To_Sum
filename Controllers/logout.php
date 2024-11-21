<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: ../Views/Welcome.html"); // Redirect to the Welcome page
exit;
?>
