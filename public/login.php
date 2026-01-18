<?php
session_start();
require_once "../app/controllers/loginController.php";

// If user is already logged in, redirect to home
if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Display login page
require_once "../app/views/login/loginPage.php";
?>