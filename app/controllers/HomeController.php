<?php

require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/courseModel.php";
require_once __DIR__ . "/../models/tutorModel.php";

$courses = getAllCourses($conn);
$tutors = getAllTutors($conn);

include __DIR__ . "/../views/home/home.php";

?>