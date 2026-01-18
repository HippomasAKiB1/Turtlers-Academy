<?php

/**
 * TURTLERS ACADEMY - LOGOUT ACTION
 * Handles user logout and session destruction
 */

session_start();

// Destroy session
session_destroy();

// Clear session variables
$_SESSION = [];

// Redirect to public index (simple absolute path)
header('Location: /repo/Turtlers-Academy/public/index.php');
exit;

?>
