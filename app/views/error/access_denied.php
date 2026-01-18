<?php
// Compute public path for asset/route links
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
    <title>Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8d7da;
            font-family: 'Poppins', sans-serif;
            color: #721c24;
        }
        .container {
            text-align: center;
            padding: 40px;
            border: 1px solid #f5c6cb;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .btn-home {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #721c24;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>You are unauthorized to access</h1>
        <p>Your account was not found in our records or you do not have permission to view this page.</p>
        <a href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/login.php" class="btn-home">Go to Login</a>
    </div>
</body>
</html>
