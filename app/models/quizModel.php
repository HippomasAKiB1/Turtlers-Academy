<?php
require_once __DIR__ . "/../../core/database.php";

// Get all quizzes
function getQuizzes()
{
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM quizzes");
    return $res;
}

function getSingleQuiz($quiz_id)
{
    global $conn;
    $quiz_id = intval($quiz_id);
    $res = mysqli_query($conn, "SELECT * FROM quizzes WHERE id=$quiz_id");
    return mysqli_fetch_assoc($res);
}

function getQuestions($quiz_id)
{
    global $conn;
    $quiz_id = intval($quiz_id);
    $res = mysqli_query($conn, "SELECT * FROM questions WHERE quiz_id=$quiz_id");
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

// Save quiz attempt
function saveAttempt($user_id, $quiz_id, $score, $total, $percentage)
{
    global $conn;
    $user_id = intval($user_id);
    $quiz_id = intval($quiz_id);
    $score = intval($score);
    $total = intval($total);
    $percentage = floatval($percentage);

    mysqli_query(
        $conn,
        "INSERT INTO quiz_attempts (user_id, quiz_id, score, total, percentage)
         VALUES ($user_id, $quiz_id, $score, $total, $percentage)"
    );
}

// Get leaderboard
function getLeaderboard($limit = 10)
{
    global $conn;
    $res = mysqli_query(
        $conn,
        "SELECT u.name, MAX(q.percentage) AS best
         FROM quiz_attempts q
         JOIN users u ON u.id = q.user_id
         GROUP BY q.user_id
         ORDER BY best DESC
         LIMIT $limit"
    );
    return $res;
}
