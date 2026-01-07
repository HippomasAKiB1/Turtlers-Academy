<?php
require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/forumModel.php";

$user_id = $_SESSION['user_id'] ?? 999;
$action = $_GET['action'] ?? 'list';

// List all threads
if ($action === 'list') {
    $query = $_GET['q'] ?? '';
    if ($query) {
        $threads = searchThreads($conn, $query);
    } else {
        $threads = getAllThreads($conn);
    }
    include __DIR__ . "/../views/forum/forum_list.php";
    exit;
}

if ($action === 'create') {
    include __DIR__ . "/../views/forum/forum_create.php";
    exit;
}

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $desc = $_POST['description'] ?? '';

    if (empty($title) || empty($desc)) {
        die("All fields are required.");
    }

    createThread($conn, $user_id, $title, $desc);
    header("Location: forum.php");
    exit;
}

if ($action === 'view') {
    $thread_id = intval($_GET['id'] ?? 0);
    $thread = mysqli_fetch_assoc(getSingleThread($conn, $thread_id));
    $comments = getComments($conn, $thread_id);
    include __DIR__ . "/../views/forum/forum_thread.php";
    exit;
}

if ($action === 'comment' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $thread_id = intval($_POST['thread_id'] ?? 0);
    $comment = $_POST['comment'] ?? '';

    if (empty($comment)) {
        if (isset($_POST['ajax'])) {
            echo json_encode(['status' => 'error', 'message' => 'Empty comment']);
            exit;
        }
        die("Comment cannot be empty.");
    }

    if (addComment($conn, $thread_id, $user_id, $comment)) {
        if (isset($_POST['ajax'])) {
            echo json_encode([
                'status' => 'ok',
                'user' => 'Guest User',
                'comment' => $comment,
                'date' => date("Y-m-d H:i:s")
            ]);
            exit;
        }
    } else {
        // Insert failed
        if (isset($_POST['ajax'])) {
            $err = mysqli_error($conn);
            echo json_encode([
                'status' => 'error',
                'message' => "Posting failed. (DB Error: $err)"
            ]);
            exit;
        }
        die("Posting failed: " . mysqli_error($conn));
    }

    header("Location: forum.php?action=view&id=" . $thread_id);
    exit;
}
