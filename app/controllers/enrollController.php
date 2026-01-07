<?php

require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/courseModel.php";
require_once __DIR__ . "/../models/enrollModel.php";

if (!isset($_SESSION['user_id'])) {
    $user_id = 999;
} else {
    $user_id = $_SESSION['user_id'];
}

$course_id = intval($_GET['id'] ?? 0);

$course = getCourseDetails($conn, $course_id);
if (!$course)
    die("Course not found");

$enrolled = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (
        empty($_POST['full_name']) ||
        empty($_POST['email']) ||
        empty($_POST['phone'])
    ) {
        if (isset($_POST['ajax'])) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            exit;
        }
        die("All fields are required");
    }

    try {
        if (!isAlreadyEnrolled($conn, $user_id, $course_id)) {
            $res = enrollUser(
                $conn,
                $user_id,
                $course_id,
                $_POST['full_name'],
                $_POST['email'],
                $_POST['phone']
            );

            if (!$res) {
                throw new Exception("Enrollment failed (DB: " . mysqli_error($conn) . ")");
            }
        }
    } catch (Throwable $e) {
        if (isset($_POST['ajax'])) {
            if (ob_get_length())
                ob_clean();
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            exit;
        }
        die($e->getMessage());
    }

    if (isset($_POST['ajax'])) {
        if (ob_get_length())
            ob_clean();
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'course_name' => $course['name']]);
        exit;
    }

    $enrolled = true;
}

include __DIR__ . "/../views/enroll/enrollForm.php";
