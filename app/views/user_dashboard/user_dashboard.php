<?php
    include_once '../../partials/header.php';
?>

<?php
    
    $studentName = "Nazat";
    $program = "BSc in Computer Science";
    $semester = "9th";

    $courses = [
        ["name" => "Web Technologies", "progress" => 75],
        ["name" => "Database Systems", "progress" => 50],
        ["name" => "Computer Graphics", "progress" => 30]
    ];

    $enrolled = 5;
    $completed = 2;
    $inProgress = 3;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="/Turtlers-Academy/public/assets/css/userdashboard.css">
        
        <script>
            const theme = localStorage.getItem("siteTheme") || "light-mode";
            document.documentElement.classList.add(theme);
        </script>
    </head>
    <body class="<?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light-mode'; ?>">
        <section class="dashboard">

            <h1>Student Dashboard</h1>

            <div class="dashboard-card">
                <h3>Welcome, <?php echo $studentName; ?></h3>
                <p>Program: <?php echo $program; ?></p>
                <p>Semester: <?php echo $semester; ?></p>
            </div>

            <div class="dashboard-card">
                <h3>Course Progress</h3>
                
                <?php foreach ($courses as $course): ?>
                    <p><?php echo $course['name']; ?></p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $course['progress']; ?>%">
                            <?php echo $course['progress']; ?>%
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="dashboard-card stats">
                <div>
                    <h4>Courses Enrolled</h4>
                    <p><?php echo $enrolled; ?></p>
                </div>
                <div>
                    <h4>Completed</h4>
                    <p><?php echo $completed; ?></p>
                </div>
                <div>
                    <h4>In Progress</h4>
                    <p><?php echo $inProgress; ?></p>
                </div>
            </div>

            <div class="dashboard-card">
                <h3>Recent Activity</h3>
                <ul>
                    <li>✔ Completed HTML Module</li>
                    <li>✔ Submitted DB Assignment</li>
                    <li>⏳ Watching CSS Flexbox Lesson</li>
                </ul>
            </div>

        </section>


        <script src="/Turtlers-Academy/public/assets/js/userdashboard.js"></script>
    </body>
</html>

<?php
    include_once '../../views/bgtoggler/bgtoggler.php';
?>

<?php
    include_once '../../partials/footer.php';
?>