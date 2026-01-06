<?php include '../../controllers/dashboardController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/student_dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div class="profile-section">
            <img src="/Turtlers-Academy/public/assets/images/profile.png" class="profile-img" alt="Profile">
            <div class="profile-info">
                <h3>Nazat</h3>
                <p>Turtlers Academy</p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <button class="nav-btn" onclick="ajaxLoadAboutMe()">About Me</button>
            <button class="nav-btn">Forum</button>
            <button class="nav-btn">Help</button>
        </nav>
        <div class="sidebar-footer">
            <a href="../../auth/logout.php" class="logout-link">Logout</a>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-nav">
            <button class="tab-btn active" onclick="selectTab(this)">Library</button>
            <button class="tab-btn" onclick="selectTab(this)">Courses</button>
            <button class="tab-btn" onclick="selectTab(this)">Resources</button>
        </header>

        <div id="main-display">
            <section class="course-grid">
                <?php foreach ($availableCourses as $id => $course): ?>
                    <div class="course-card">
                        <img src="<?php echo $course['image']; ?>" class="course-card-img">
                        <h4><?php echo $course['title']; ?></h4>
                        <button class="view-btn" onclick="ajaxLoadDetail('<?php echo $id; ?>')">View Details</button>
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>
</div>

<script src="../../../public/assets/js/student_dashboard.js?v=<?php echo time(); ?>"></script>
</body>
</html>