<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Quiz Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            width: 100%;
            max-width: 800px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #1a1a1a;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .result-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border: 1px solid #eee;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .result-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .quiz-info h3 {
            margin: 0 0 5px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .quiz-info p {
            margin: 0;
            color: #777;
            font-size: 0.9rem;
        }

        .score-badge {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
            min-width: 80px;
            text-align: center;
        }

            background: #e6fcf5;
            color: #0ca678;
        }

        .score-badge.fail {
            background: #fff5f5;
            color: #ff6b6b;
        }

        .empty-state {
            text-align: center;
            padding: 50px;
            color: #888;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-back:hover {
            background: #000;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>My Learning Progress</h2>

                <?php if (mysqli_num_rows($results) == 0): ?>
            <div class="empty-state">
                <p>You haven't taken any quizzes yet.</p>
                        <a href="/repo/Turtlers-Academy/public/quiz.php" class="btn-back">Take a Quiz</a>
            </div>
        <?php else: ?>
            <div class="results-list">
                <?php while ($row = mysqli_fetch_assoc($results)): ?>
                    <?php
                    $percentage = ($row['total'] > 0) ? ($row['score'] / $row['total']) * 100 : 0;
                    $statusClass = ($percentage >= 50) ? 'pass' : 'fail';
                    $statusText = ($percentage >= 50) ? 'Passed' : 'Needs Work';
                    ?>
                    <div class="result-card">
                        <div class="quiz-info">
                            <h3><?= htmlspecialchars($row['title']) ?></h3>
                            <p>Attempted on <?= date("M d, Y", strtotime($row['attempted_at'])) ?></p>
                        </div>
                        <div class="score-box">
                            <div class="score-badge <?= $statusClass ?>">
                                <?= $row['score'] ?> / <?= $row['total'] ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <a href="/repo/Turtlers-Academy/public/index.php" class="btn-back">Back to Dashboard</a>
        <?php endif; ?>

    </div>

</body>

</html>