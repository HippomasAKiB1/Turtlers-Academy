<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link rel="stylesheet" href="public/assets/css/coursegrid_style.css">
</head>
<body>
<div class="course-grid">
<?php foreach($courses as $course): ?>
    <div class="course-box" data-id="<?= $course['id'] ?>">
        <h3><?= $course['name'] ?></h3>
        <p><?= $course['short_desc'] ?></p>
        <button class="enroll-btn" onclick="location.href='../enroll/enroll.php?id=<?= $course['id'] ?>'">Enroll</button>
        <button class="details-btn">Details</button>
    </div>
<?php endforeach; ?>
</div>

<!-- Popup -->
<div id="course-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div id="popup-body"></div>
    </div>
</div>

<script src="public/assets/js/course_script.js"></script>
</body>
</html>
