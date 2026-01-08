<?php
include "../../models/AdminCourseModel.php";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $course = getCourseById($db, $id);
} else {
    $course = null;
}


if (!$course) {
    die("Course not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['course_name']); ?> - Details</title>
    <link rel="stylesheet" href="../../../public/assets/css/course_details.css">
</head>
<body>

  <div class="course-summary">
    <div class="course-info">
      <h2 class="course-name"><?php echo htmlspecialchars($course['course_name']); ?></h2>
      <p><strong>Course ID:</strong> <?php echo htmlspecialchars($course['id']); ?></p>
      <p><strong>Course Code:</strong> <?php echo htmlspecialchars($course['course_code']); ?></p>
      <p><strong>Instructor:</strong> <?php echo htmlspecialchars($course['instructor_name']); ?></p>
    </div>
    
    <div class="course-image">
      <img src="../../../public/assets/upload/<?php echo htmlspecialchars($course['course_image']); ?>" alt="Course Image">
    </div>
  </div>

  <div class="course-overview">
    <h3>Course Overview</h3>
    <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
    
    <a href="../download_lesson/download_lesson.php?course_id=<?php echo $course['id']; ?>" class="download-btn">
        Download Course Materials
    </a>
</div>

</body>
</html>

