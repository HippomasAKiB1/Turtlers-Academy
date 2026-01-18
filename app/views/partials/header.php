<?php
// Compute base/public paths so links resolve whether entry is root or public
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = preg_replace('#/public.*$#', '', $scriptName);
if ($basePath === '/' || $basePath === '\\') {
    $basePath = '';
}
$publicPath = $basePath . '/public';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turtlers Academy</title>
    <base href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #111;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }


        .academy-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .academy-header .bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 48px;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #111;
        }

        .academy {
            font-weight: 600;
            color: #888;
        }

        nav.main-nav {
            display: flex;
            gap: 28px;
        }

        nav.main-nav a {
            text-decoration: none;
            color: #333;
            font-size: 15px;
            opacity: 0.75;
        }

        nav.main-nav a:hover {
            opacity: 1;
        }

        .btn-login {
            padding: 8px 18px;
            border-radius: 4px;
            border: 1.5px solid #111;
            background: transparent;
            text-decoration: none;
            color: #111;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #111;
            color: #fff;
        }


        .main-content {
            flex: 1;
            padding: 80px 20px;
            text-align: center;
        }
    </style>

</head>

<body>
    <header class="academy-header">
        <div class="bar">

            <div>
                <a href="index.php" style="text-decoration:none;">
                    <span class="brand">&lt;Turtlers<span class="academy">Academy</span></span>
                </a>
            </div>

            <nav class="main-nav">
                <a href="index.php">Home</a>
                <a href="course.php">Courses</a>
                <a href="forum.php">Forum</a>
                <a href="quiz.php">Quizzes</a>
                <a href="results.php">Results</a>
                <a href="#about">About</a>
            </nav>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="btn-login" href="index.php#mydashboard">Dashboard</a>
            <?php else: ?>
                <a class="btn-login" href="login.php">Log In</a>
            <?php endif; ?>

        </div>
    </header>

    <main class="main-content">