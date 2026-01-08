<?php
require_once "../../models/AdminCourseModel.php";
require_once "../../models/LessonModel.php";


if (isset($_GET['course_id'])) {
    $course_id = (int)$_GET['course_id'];
    $course = getCourseById($db, $course_id);
    $lessons = getLessonsByCourse($db, $course_id);
} else {
    die("Course ID not specified.");
}

if (!$course) {
    die("Course not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download Materials - <?php echo htmlspecialchars($course['course_name']); ?></title> 
    <link rel="stylesheet" href="../../../public/assets/css/download_lesson.css">
</head>
<body>

    <div class="main-content">
        <div class="content-wrapper">
            <h2>Course Materials: <?php echo htmlspecialchars($course['course_name']); ?></h2>
            
            <table class="materials-table">
                <thead>
                    <tr>
                        <th>Week / Lecture</th>
                        <th>Lesson Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($lessons)): ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">No materials available yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($lessons as $lesson): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lesson['lecture_week']); ?></td>
                            <td><?php echo htmlspecialchars($lesson['lesson_title']); ?></td>
                            <td>
                                <a href="../../../public/assets/lesson/<?php echo $lesson['file_path']; ?>" 
                                   download 
                                   class="download-btn">
                                    Download
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div style="text-align:center; margin-top:20px;">
                <a href="../course_details/course_details.php?id=<?php echo $course_id; ?>" class="back-link">&larr; Back to Course Details</a>
            </div>
        </div>
    </div>

</body>
</html>