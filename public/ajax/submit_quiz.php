<?php
session_start();
require_once "../../app/models/quizModel.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    $user_id = 999;
} else {
    $user_id = $_SESSION['user_id'];
}

$quiz_id = intval($_POST['quiz_id'] ?? 0);
$answers = json_decode($_POST['answers'] ?? '{}', true);


if (!$quiz_id) {
    echo json_encode(['status' => 'error']);
    exit;
}


$questions = getQuestions($quiz_id);
$total = count($questions);
$score = 0;

foreach ($questions as $q) {
    $qid = $q['id'];
    if (isset($answers[$qid]) && $answers[$qid] === $q['correct']) {
        $score++;
    }
}


$percentage = round(($score / $total) * 100, 2);


saveAttempt($user_id, $quiz_id, $score, $total, $percentage);

echo json_encode([
    'status' => 'ok',
    'score' => $score,
    'total' => $total,
    'percentage' => $percentage
]);
