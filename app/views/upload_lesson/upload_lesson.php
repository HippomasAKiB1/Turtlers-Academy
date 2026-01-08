<?php
require_once "../../models/LessonModel.php";
require_once "../../models/AdminCourseModel.php";

$courses = getAllCourses($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Lesson</title>
    <link rel="stylesheet" href="../../../public/assets/css/upload_lesson.css">
</head>
<body>
        <div class="form-container">
            <h2>Upload New Lesson</h2>

            <form action="../../controllers/LessonControllers.php" method="POST" enctype="multipart/form-data">

                <label>Select Course</label>
                <select name="course_id" required>
                    <option value="">Choose Course</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>">
                            <?= htmlspecialchars($c['course_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Lecture / Week</label>
                <input type="text" name="lecture_week" placeholder="e.g. Lecture 1" required>

                <label>Lesson Title</label>
                <input type="text" name="lesson_title" placeholder="e.g. Introduction to CSS" required>

                <label>Select File</label>
                <input type="file" name="lesson_file" required>

                <button type="submit" name="add_lesson" id="addBtn">
                    Upload Lesson
                </button>
            </form>
        </div>
</body>
</html>

