<?php include __DIR__ . "/../../partials/header.php"; ?>

<link rel="stylesheet" href="/repo/Turtlers-Academy/public/assets/css/home.css">

<!-- Hero Section -->
<section class="hero-section">
    <h1 class="hero-title">
        Welcome to <span class="accent-text">Turtlers Academy</span>
    </h1>
    <p class="hero-subtitle">
        Unlock your potential with our expert-led courses. Join a community of learners and achieve your goals today.
    </p>
    <a href="course.php" class="hero-btn">Discover Courses</a>
</section>

<!-- Courses Section -->
<section id="courses" class="courses-section">
    <div class="section-container">
        <div class="section-header">
            <h2>Discover Our Courses</h2>
            <p>Explore a wide range of topics curated for you.</p>
        </div>

        <div class="course-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-box" data-id="<?= $course['id'] ?>">
                    <h3><?= htmlspecialchars($course['course_name']) ?></h3>
                    <p><?= htmlspecialchars($course['description']) ?></p>
                    <div class="course-actions">
                        <button class="btn btn-primary" onclick="enrollCourse(<?= $course['id'] ?>)">
                            Enroll Now
                        </button>
                        <button class="btn btn-secondary" onclick="showCourseDetails(<?= $course['id'] ?>)">
                            Details
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Tutors Section -->
<section id="tutors" class="tutors-section">
    <div class="section-container">
        <div class="section-header">
            <h2>Get Introduced to Our Tutors</h2>
            <p>Learn from the best in the industry.</p>
        </div>

        <div class="tutors-grid">
            <?php foreach ($tutors as $tutor): ?>
                <div class="tutor-card">
                    <div class="tutor-avatar">
                        <?= strtoupper(substr($tutor['fullname'], 0, 1)) ?>
                    </div>
                    <h3 class="tutor-name"><?= htmlspecialchars($tutor['fullname']) ?></h3>
                    <p class="tutor-title">Expert Tutor</p>
                    <p class="tutor-email"><?= htmlspecialchars($tutor['email']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Course Details Popup -->
<div id="course-popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeCoursePopup()">&times;</span>
        <div id="popup-body"></div>
    </div>
</div>

<script src="/repo/Turtlers-Academy/public/assets/js/home.js"></script>

<?php include __DIR__ . "/../../partials/footer.php"; ?>