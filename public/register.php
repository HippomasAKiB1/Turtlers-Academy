<?php
session_start();
require_once "../app/controllers/loginController.php";
require_once "../app/controllers/registerController.php";

// If user is already logged in, redirect to home
if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Display registration page
require_once "../app/views/register/registerPage.php";
?>
