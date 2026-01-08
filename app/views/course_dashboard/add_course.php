<?php
require_once "../../models/AdminCourseModel.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../public/assets/css/add_course.css">
    
    <script src="../../../public/assets/js/add_course.js" defer></script>
</head>
<body>
    <div class="form-container">
        <h2 style="margin-top: 20px; color: #111;">Add New Course</h2>
        
        <form action="../../controllers/AdminCourseControllers.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            
            <label>Course Code</label>
            <input type="text" name="course_code" id="code" placeholder="e.g. web-dev-101" required>

            <label>Course Name</label>
            <input type="text" name="course_name" id="name" placeholder="Enter course title" required>

            <label>Instructor Name</label>
            <input type="text" name="instructor_name" id="instructor" required>

            <label>Description</label>
            <textarea name="description" id="description" rows="5"></textarea>

            <label>Course Image</label>
            <input type="file" name="course_image" id="image">

            <div class="button-container" style="margin-top: 20px;">
                <button type="submit" name="add_course" id="addBtn" class="btn-login">Add Course</button>
            </div>
            
            <p id="message"></p>
        </form>
    </div>
</body>
</html>
