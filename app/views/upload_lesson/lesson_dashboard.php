<?php
$conn = mysqli_connect("localhost", "root", "", "turtlers_academy");
$sql = "SELECT id, lesson_title, lecture_week, file_path, created_at FROM lesson ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
?>

<div class="lesson-list-wrapper">
    <div class="lesson-list-header">
        <h3>Shared Resources</h3>
        <a href="../upload_lesson/upload_lesson.php" class="btn-add">Upload New</a>
    </div>

    <div class="lesson-table-container">
        <table class="course-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Week</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($res && mysqli_num_rows($res) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($res)) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['lesson_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['lecture_week']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                            <td>
                                <a href="/Turtlers-Academy/public/assets/upload/<?php echo $row['file_path']; ?>" class="edit-link" target="_blank">View File</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No resources found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php mysqli_close($conn); ?>
