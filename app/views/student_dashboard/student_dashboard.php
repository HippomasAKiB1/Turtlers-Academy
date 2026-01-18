<?php
session_start();
$_SESSION['student_name'] = "Nazat";
include '../../controllers/dashboardController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/repo/Turtlers-Academy/public/assets/css/student_dashboard.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile-section">
                <img src="/repo/Turtlers-Academy/public/assets/images/profile.png" class="profile-img">
                <div class="profile-info">
                    <h3><?php echo $_SESSION['student_name']; ?></h3>
                    <p>Student</p>
                </div>
            </div>
            <nav class="sidebar-nav">
                <button class="nav-btn" onclick="ajaxLoadAboutMe()">About Me</button>
                <button class="nav-btn" onclick="ajaxLoadView('view_bookmarks')">Bookmarked Courses</button>
                <button class="nav-btn">Forum</button>
                <button class="nav-btn">Help</button>
            </nav>
            <div class="sidebar-footer">
                <a href="/repo/Turtlers-Academy/app/actions/logout.php" class="logout-link">Logout</a>
            </div>
        </aside>

        <main class="main-content">
            <?php
            $displayName = $_SESSION['student_name'];
            include '../components/greeting_clock.php';
            ?>

            <header class="top-nav">
                <button class="tab-btn active" onclick="selectTab(this); location.reload();">Library</button>
                <button class="tab-btn" onclick="selectTab(this); ajaxLoadView('view_courses');">Courses</button>
                <button class="tab-btn" onclick="selectTab(this); ajaxLoadView('view_resources');">Resources</button>
                <button class="tab-btn" onclick="selectTab(this)">Quizzes</button>
                <button class="tab-btn" onclick="selectTab(this)">Results</button>
            </header>

            <div id="main-display">
            </div>
        </main>
    </div>

    <script src="/repo/Turtlers-Academy/public/assets/js/student_dashboard.js?v=<?php echo time(); ?>"></script>
    <script src="/repo/Turtlers-Academy/public/assets/js/bookmark.js?v=<?php echo time(); ?>"></script>
    <?php include "../bgtoggler/bgtoggler.php" ?>
</body>

</html>