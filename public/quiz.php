<?php
session_start();
require_once "../app/controllers/quizController.php";

$user_id = $_SESSION['user_id'] ?? 0;

$action = $_GET['action'] ?? 'list';
$quiz_id = intval($_GET['id'] ?? 0);


if ($action === 'list') {
    quizList();
} elseif ($action === 'take' && $quiz_id > 0) {
    takeQuiz($quiz_id);
} elseif ($action === 'leaderboard') {
    leaderboard();
} else {
    echo "Invalid action!";
}
