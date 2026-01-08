<?php 
require_once __DIR__ . "/../../models/AdminCourseModel.php";
// AdminCourseModel already creates $db connection, but we can reuse $conn if it's available
$courses = getManagementCourses($db);
?>

<div class="course-mgmt-wrapper">
    <div class="header-group">
        <h3>Course Management</h3>
        <a href="../course_dashboard/add_course.php" class="btn-add">Add New Course</a>
    </div>

    <div class="table-container">
        <table class="course-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Instructor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($courses as $course): ?>
                <tr>
                    <td><?php echo $course['id']; ?></td>
                    <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                    <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($course['instructor_name']); ?></td>
                    <td>
                        <a href="../course_dashboard/edit_course.php?id=<?php echo $course['id']; ?>" class="edit-link">Edit</a> | 
                        <a href="../../controllers/AdminCourseControllers.php?delete_id=<?php echo $course['id']; ?>" 
                           class="delete-link" 
                           onclick="return confirm('Delete this course?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
