<!DOCTYPE html>
<html>
<head>
    <title>My Quiz Results</title>
    <link rel="stylesheet" href="/public/assets/css/quizresult.css">
</head>
<body>

<div class="container">
    <h2>My Quiz Results</h2>

    <?php if (mysqli_num_rows($results) == 0): ?>
        <p class="empty">You have not attempted any quiz yet.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Quiz Title</th>
                <th>Score</th>
                <th>Total</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($results)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= $row['score'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= date("d M Y", strtotime($row['attempted_at'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

    <a href="/public/dashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>
