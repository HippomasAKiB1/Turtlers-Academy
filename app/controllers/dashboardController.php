<?php
// Data
$studentProfile = [
    "name" => "Nazat",
    "institution" => "Turtlers Academy of Tech",
    "age" => 21,
    "cgpa" => 3.85,
    "enrolled_courses" => ["Web Technologies", "Database Systems"]
];

$availableCourses = [
    "web101" => ["title" => "Web Technologies", "tutor" => "Dr. Smith", "image" => "/Turtlers-Academy/public/assets/images/web.jpg", "desc" => "HTML/CSS/PHP"]
];

// AJAX About Me
if (isset($_GET['action']) && $_GET['action'] === 'aboutme') {
    echo "
    <div style='background:white; padding:20px; border-radius:10px;'>
        <button onclick='location.reload()'>← Back</button>
        <h2>About Me</h2>
        <p>Name: {$studentProfile['name']}</p>
        <p>Institution: {$studentProfile['institution']}</p>
        <p>Age: {$studentProfile['age']}</p>
        <p>CGPA: {$studentProfile['cgpa']}</p>
    </div>";
    exit;
}

// AJAX Details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($availableCourses[$id])) {
        echo "<div><h2>{$availableCourses[$id]['title']}</h2></div>";
    }
    exit;
}
?>