<?php


require_once __DIR__ . '/../../core/database.php';
require_once __DIR__ . '/../models/courseModel.php';

// For testing
// $_SESSION['user_id'] = 1;
// $_SESSION['username'] = 'akib';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// AJAX popup request
if(isset($_GET['action']) && $_GET['action'] === "courseDetails"){
    $course_id = intval($_GET['id']);
    $course = getCourseDetails($conn, $course_id);
    $rating = getCourseRating($conn, $course_id);

    $enrolled = $user_id ? isUserEnrolled($conn, $user_id, $course_id) : false;

    include __DIR__ . '/../views/course/coursePopup.php';
    exit;
}

$courses = getAllCourses($conn);
include __DIR__ . '/../views/course/courseGrid.php';
