<h2><?= htmlspecialchars($course['course_name'] ?? $course['name'] ?? 'Course') ?></h2>
<p><?= htmlspecialchars($course['short_description'] ?? $course['description'] ?? '') ?></p>
<p><?= htmlspecialchars($course['full_description'] ?? '') ?></p>
<p><strong>Average Rating:</strong> <?= $rating ?>/5</p>

<?php if($user_id && $enrolled): ?>
    <h3>Leave a Comment</h3>
    <form method="POST" action="submitComment.php">
        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
        <textarea name="comment" placeholder="Your comment"></textarea>
        <button type="submit">Submit</button>
    </form>
<?php elseif(!$user_id): ?>
    <p style="color:#888;"><em>Please log in to comment or rate this course.</em></p>
<?php else: ?>
    <p style="color:#888;"><em>You must enroll to comment or rate this course.</em></p>
<?php endif; ?>
