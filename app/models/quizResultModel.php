<?php
require_once __DIR__ . '/../../core/database.php';

function getStudentQuizResults($user_id)
{
    global $conn;

    $sql = "SELECT qr.*, q.title 
            FROM quiz_results qr
            JOIN quizzes q ON qr.quiz_id = q.id
            WHERE qr.user_id = ?
            ORDER BY qr.attempted_at DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
