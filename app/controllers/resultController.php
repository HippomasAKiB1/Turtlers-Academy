<?php
//session_start();

if (!isset($_SESSION['user_id'])) {
    $user_id = 999;
} else {
    $user_id = $_SESSION['user_id'];
}

require_once __DIR__ . '/../models/resultModel.php';

$results = getQuizResultsByStudent($user_id);

require_once __DIR__ . '/../views/quiz/result.php';
