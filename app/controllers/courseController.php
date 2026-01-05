<?php
session_start();
include "../core/database.php";
include "../models/courseModel.php";

// simulate a logged-in user (for now)
$_SESSION['user_id'] = 1;
$_SESSION['username'] = 'akib';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// For popup AJAX request
if(isset($_GET['action']) && $_GET['action'] == "courseDetails"){
    $course_id = $_GET['id'];
    $course = getCourseDetails($conn, $course_id);
    $rating = getCourseRating($conn, $course_id);

    $enrolled = $user_id ? isUserEnrolled($conn, $user_id, $course_id) : false;

    include "../views/coursePopup.php";
    exit;
}

// Normal course grid page
$courses = getAllCourses($conn);
include "../views/courseGrid.php";
?>
