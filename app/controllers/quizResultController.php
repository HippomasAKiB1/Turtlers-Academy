<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../models/quizResultModel.php';

$user_id = $_SESSION['user_id'];
$results = getStudentQuizResults($user_id);

require_once __DIR__ . '/../views/quiz/quizresults.php';
