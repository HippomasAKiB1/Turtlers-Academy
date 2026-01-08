<?php

require_once __DIR__ . "/../models/quizModel.php";


function quizList()
{
    $quizzes = getQuizzes();
    include __DIR__ . "/../views/quiz/quizlist.php";
}

function takeQuiz($quiz_id)
{
    $quiz_id = intval($quiz_id);
    if ($quiz_id <= 0)
        die("Invalid quiz ID");

    $quiz = getSingleQuiz($quiz_id);
    if (!$quiz)
        die("Quiz not found");

    $questions = getQuestions($quiz_id);
    include __DIR__ . "/../views/quiz/quiztake.php";
}


function leaderboard()
{
    $leaders = getLeaderboard();
    include __DIR__ . "/../views/quiz/quizleaderboard.php";
}
