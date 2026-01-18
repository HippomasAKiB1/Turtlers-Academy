<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turtlers Academy</title>
    <!-- Using simple absolute paths under /Turtlers-Academy/public/ -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    <style>
        
           *{ margin: 0; 
                 padding: 0; 
                 box-sizing: border-box;
            }

        body {
                font-family: 'Poppins', sans-serif;
                background-color: #ffffff;
                color: #111;
                line-height: 1.6;
                min-height: 100vh;
                display: flex; flex-direction: column;
            }

        
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

        nav.main-nav a:hover { opacity: 1; }

        .btn-auth {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login, .btn-logout {
            padding: 8px 18px; 
            border-radius: 4px;
            border: 1.5px solid #111; 
            background: transparent;
            text-decoration: none; 
            color: #111; 
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover, .btn-logout:hover {
            background: #111; 
            color: #fff;
        }

        .btn-signup {
            padding: 8px 18px;
            border-radius: 4px;
            border: 1.5px solid #ff7b00;
            background: #ff7b00;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            background: #e06a00;
            border-color: #e06a00;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 0 15px;
            border-right: 1px solid #e5e5e5;
            border-left: 1px solid #e5e5e5;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: #ff7b00;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 0.9rem;
            color: #111;
            font-weight: 600;
        }

        .user-role {
            font-size: 0.75rem;
            color: #888;
            text-transform: capitalize;
        }

        
        .main-content { 
            flex: 1; 
            padding: 80px 20px; 
            text-align: center; 
        }

        /* Responsive */
        @media (max-width: 768px) {
            .academy-header .bar {
                padding: 15px 20px;
            }

            .brand {
                font-size: 18px;
            }

            nav.main-nav {
                gap: 15px;
                font-size: 13px;
            }

            .user-info {
                gap: 10px;
                padding: 0 10px;
            }
        }
        
    </style>

</head>

<body>
<header class="academy-header">
    <div class="bar">

        <div>
            <span class="brand">&lt;Turtlers<span class="academy">Academy</span></span>
        </div>

        <nav class="main-nav">
            <a href="/repo/Turtlers-Academy/public/index.php">Home</a>
            <a href="/repo/Turtlers-Academy/public/index.php#courses">Courses</a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <a href="/repo/Turtlers-Academy/public/index.php#mydashboard">My Dashboard</a>
                <a href="/repo/Turtlers-Academy/public/index.php#resources">Resources</a>
            <?php endif; ?>
        </nav>

        <div class="btn-auth">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <!-- User Logged In -->
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr($_SESSION['full_name'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?></span>
                        <span class="user-role"><?= htmlspecialchars($_SESSION['role'] ?? 'student') ?></span>
                    </div>
                </div>
                <a class="btn-logout" href="/repo/Turtlers-Academy/app/actions/logout.php">Log Out</a>
            <?php else: ?>
                <!-- User Not Logged In -->
                <a class="btn-login" href="/repo/Turtlers-Academy/public/login.php">Log In</a>
                <a class="btn-signup" href="/repo/Turtlers-Academy/public/register.php">Sign Up</a>
            <?php endif; ?>
        </div>

    </div>
</header>

<main class="main-content">

<!-- Initialize User Login Status for JavaScript -->
<script>
    const USER_LOGGED_IN = <?= (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ? 'true' : 'false' ?>;
</script>

<!-- Load Authentication Popup Module -->
<script src="/repo/Turtlers-Academy/public/assets/js/auth-popup.js"></script>

