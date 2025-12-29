<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turtlers Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* Global*/
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #111;
            line-height: 1.6;
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* Header */
        .academy-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            position: sticky; top: 0; width: 100%;
            z-index: 1000;
        }
        .academy-header .bar {
            display: flex; justify-content: space-between;
            align-items: center; padding: 18px 48px;
        }
        .brand { font-size: 22px; font-weight: 800; color: #111; }
        .academy { font-weight: 600; color: #888; }

        nav.main-nav { display: flex; gap: 28px; }
        nav.main-nav a {
            text-decoration: none; color: #333;
            font-size: 15px; opacity: 0.75;
        }
        nav.main-nav a:hover { opacity: 1; }

        .btn-login {
            padding: 8px 18px; border-radius: 4px;
            border: 1.5px solid #111; background: transparent;
            text-decoration: none; color: #111; font-weight: 600;
        }
        .btn-login:hover {
            background: #111; color: #fff;
        }

        /* MAIN */
        .main-content { flex: 1; padding: 80px 20px; text-align: center; }
    </style>

</head>

<body>
<header class="academy-header">
    <div class="bar">

        <div>
            <span class="brand">&lt;Turtlers<span class="academy">Academy</span></span>
        </div>

        <nav class="main-nav">
            <a href="#home">Home</a>
            <a href="#catagories">Catagories</a>
            <a href="#courses">Courses</a>
            <a href="#admissions">Admissions</a>
            <a href="#resources">Resources</a>
            <a href="#about">About</a>
        </nav>

        <a class="btn-login" href="#login">Log In</a>

    </div>
</header>

<main class="main-content">
