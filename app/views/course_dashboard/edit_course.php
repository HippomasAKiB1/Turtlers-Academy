<?php
require_once "../../models/AdminCourseModel.php";
 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $course = getCourseById($db, $id);
    
    if (!$course) {
        die("Error: Course not found in database.");
    }
} else {
    die("Error: No ID provided. Please go back to the dashboard.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Course - Turtlers Academy</title>
    <link rel="stylesheet" href="../../../public/assets/css/edit_course.css">
</head>
<body>
        <div class="form-container">
            <h2>Edit Course</h2>

            <form action="../../controllers/AdminCourseControllers.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                
                <label>Course Code</label>
                <input type="text" name="course_code" value="<?php echo htmlspecialchars($course['course_code']); ?>" required>
                
                <label>Course Name</label>
                <input type="text" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
                
                <label>Instructor</label>
                <input type="text" name="instructor_name" value="<?php echo htmlspecialchars($course['instructor_name']); ?>" required>

                <label>Description</label>
                <textarea name="description" required><?php echo htmlspecialchars($course['description']); ?></textarea>

                <label>Current Image:</label>
                <img src="../../../public/assets/upload/<?php echo $course['course_image']; ?>" width="100" style="margin-top: 5px; display: block;">

                <label>Replace Image (Optional)</label>
                <input type="file" name="course_image">
                
                <div class="button-container" style="margin-top: 20px;">
                     <button type="submit" name="update_course" class="btn-login">Update Course</button>
                     <a href="dashboard.php" style="display:inline-block; margin-top:10px; text-decoration:none; color:#333;">Cancel</a>
                </div>
            </form>
        </div>
</body>
</html>
