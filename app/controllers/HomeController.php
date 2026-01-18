<?php

/**
 * TURTLERS ACADEMY - HOME CONTROLLER
 * Handles home page logic and validations
 */

require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/courseModel.php";
require_once __DIR__ . "/../models/tutorModel.php";

// ====================================================
// VALIDATION FUNCTIONS
// ====================================================

/**
 * Validate course exists and is accessible
 * @param int $course_id - Course ID to validate
 * @return bool - True if valid, false otherwise
 */
function validateCourse($course_id) {
    global $conn;
    
    if (empty($course_id) || !is_numeric($course_id)) {
        return false;
    }
    
    $course_id = intval($course_id);
    
    if ($course_id <= 0) {
        return false;
    }
    
    return true;
}

/**
 * Validate courses array is not empty
 * @param array $courses - Array of courses
 * @return bool - True if valid, false otherwise
 */
function validateCoursesArray($courses) {
    return is_array($courses) && !empty($courses);
}

/**
 * Validate tutors array is not empty
 * @param array $tutors - Array of tutors
 * @return bool - True if valid, false otherwise
 */
function validateTutorsArray($tutors) {
    return is_array($tutors) && !empty($tutors);
}

/**
 * Sanitize course data for display
 * @param array $course - Course array
 * @return array - Sanitized course data
 */
function sanitizeCourse($course) {
    return [
        'id' => intval($course['id'] ?? 0),
        'course_code' => htmlspecialchars($course['course_code'] ?? '', ENT_QUOTES, 'UTF-8'),
        'course_name' => htmlspecialchars($course['course_name'] ?? '', ENT_QUOTES, 'UTF-8'),
        'instructor_name' => htmlspecialchars($course['instructor_name'] ?? '', ENT_QUOTES, 'UTF-8'),
        'description' => htmlspecialchars($course['description'] ?? '', ENT_QUOTES, 'UTF-8'),
        'course_image' => htmlspecialchars($course['course_image'] ?? '', ENT_QUOTES, 'UTF-8'),
    ];
}

/**
 * Sanitize tutor data for display
 * @param array $tutor - Tutor array
 * @return array - Sanitized tutor data
 */
function sanitizeTutor($tutor) {
    return [
        'id' => intval($tutor['id'] ?? 0),
        'fullname' => htmlspecialchars($tutor['fullname'] ?? '', ENT_QUOTES, 'UTF-8'),
        'email' => htmlspecialchars($tutor['email'] ?? '', ENT_QUOTES, 'UTF-8'),
    ];
}

// ====================================================
// DATA RETRIEVAL & PROCESSING
// ====================================================

/**
 * Get and validate all courses
 * @return array - Array of validated courses
 */
function getHomePageCourses() {
    $courses = getAllCourses($GLOBALS['conn']);
    
    if (!validateCoursesArray($courses)) {
        return [];
    }
    
    // Sanitize each course
    return array_map('sanitizeCourse', $courses);
}

/**
 * Get and validate all tutors
 * @return array - Array of validated tutors
 */
function getHomePageTutors() {
    $tutors = getAllTutors($GLOBALS['conn']);
    
    if (!validateTutorsArray($tutors)) {
        return [];
    }
    
    // Sanitize each tutor
    return array_map('sanitizeTutor', $tutors);
}

// ====================================================
// ERROR HANDLING
// ====================================================

/**
 * Handle database connection errors
 */
function handleDatabaseError() {
    if (!isset($GLOBALS['conn']) || !$GLOBALS['conn']) {
        die('Database connection error. Please contact administrator.');
    }
}

// ====================================================
// PAGE INITIALIZATION
// ====================================================

// Check database connection
handleDatabaseError();

// Get courses and tutors with validation
$courses = getHomePageCourses();
$tutors = getHomePageTutors();

// Handle empty data gracefully
if (empty($courses)) {
    error_log('No courses found on home page');
}

if (empty($tutors)) {
    error_log('No tutors found on home page');
}

// Include home view
include __DIR__ . "/../views/home/home.php";

?>