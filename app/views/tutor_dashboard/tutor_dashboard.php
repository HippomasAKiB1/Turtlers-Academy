<?php include '../../controllers/TutorController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tutor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/repo/Turtlers-Academy/public/assets/css/student_dashboard.css">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="profile-section">
            <img src="/repo/Turtlers-Academy/public/<?= ltrim($tutorProfile['image'], '/') ?>" class="profile-img">
            <div class="profile-info">
                <h3><?php echo $tutorProfile['name']; ?></h3>
                <p>Tutor</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <button class="nav-btn" onclick="ajaxTutor('view_students')">Students</button>
            <button class="nav-btn" onclick="ajaxTutor('your_course')">Your Course</button>
            <button class="nav-btn" onclick="ajaxTutor('course_settings')">Course Settings</button>
        </nav>
        <div class="sidebar-footer">
            <a href="/repo/Turtlers-Academy/app/actions/logout.php" class="logout-link">Logout</a>
        </div>
    </aside>

    <main class="main-content">
        <?php 
            $displayName = $tutorProfile['name']; 
            include '../components/greeting_clock.php'; 
        ?>
        <header class="top-nav">
            <button class="tab-btn active" onclick="ajaxTutor('view_all_courses')">Courses</button>
            <button class="tab-btn" onclick="ajaxTutor('upload_resource')">Resources</button>
        </header>
        <div id="main-display">
            <h2>Welcome back, <?php echo $tutorProfile['name']; ?></h2>
            <p>Select a sidebar option or tab to manage your dashboard.</p>
        </div>
    </main>
</div>
<?php include "../bgtoggler/bgtoggler.php"?>
<script src="/repo/Turtlers-Academy/public/assets/js/tutor_dashboard.js?v=<?php echo time(); ?>"></script>
</body>
</html>