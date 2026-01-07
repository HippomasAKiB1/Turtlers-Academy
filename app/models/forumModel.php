<?php

function getAllThreads($conn)
{
    return mysqli_query(
        $conn,
        "SELECT forum_threads.*, users.fullname 
         FROM forum_threads 
         LEFT JOIN users ON users.id = forum_threads.user_id
         ORDER BY forum_threads.created_at DESC"
    );
}

function searchThreads($conn, $query)
{
    $query = mysqli_real_escape_string($conn, $query);
    return mysqli_query(
        $conn,
        "SELECT forum_threads.*, users.fullname 
         FROM forum_threads 
         LEFT JOIN users ON users.id = forum_threads.user_id
         WHERE forum_threads.title LIKE '%$query%' OR forum_threads.description LIKE '%$query%'
         ORDER BY forum_threads.created_at DESC"
    );
}

function getSingleThread($conn, $id)
{
    $id = intval($id);
    return mysqli_query(
        $conn,
        "SELECT forum_threads.*, users.fullname 
         FROM forum_threads 
         LEFT JOIN users ON users.id = forum_threads.user_id
         WHERE forum_threads.id = $id"
    );
}

function getComments($conn, $thread_id)
{
    $thread_id = intval($thread_id);
    return mysqli_query(
        $conn,
        "SELECT forum_comments.*, users.fullname 
         FROM forum_comments 
         LEFT JOIN users ON users.id = forum_comments.user_id
         WHERE forum_comments.thread_id = $thread_id
         ORDER BY forum_comments.created_at ASC"
    );
}

function createThread($conn, $user_id, $title, $desc)
{
    $title = mysqli_real_escape_string($conn, $title);
    $desc = mysqli_real_escape_string($conn, $desc);

    mysqli_query(
        $conn,
        "INSERT INTO forum_threads(user_id, title, description)
         VALUES($user_id, '$title', '$desc')"
    );
}

function addComment($conn, $thread_id, $user_id, $comment)
{
    $comment = mysqli_real_escape_string($conn, $comment);

    return mysqli_query(
        $conn,
        "INSERT INTO forum_comments(thread_id, user_id, comment)
         VALUES($thread_id, $user_id, '$comment')"
    );
}
