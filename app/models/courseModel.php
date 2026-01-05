<?php
function getAllCourses($conn){
    $res = mysqli_query($conn, "SELECT * FROM courses");
    $courses = [];
    while($row = mysqli_fetch_assoc($res)){
        $courses[] = $row;
    }
    return $courses;
}

function getCourseDetails($conn, $id){
    $id = intval($id);
    $res = mysqli_query($conn, "SELECT * FROM courses WHERE id=$id");
    return mysqli_fetch_assoc($res);
}

function getCourseRating($conn, $id){
    $id = intval($id);
    $res = mysqli_query($conn, "SELECT AVG(rating) as avg_rating FROM ratings WHERE course_id=$id");
    $row = mysqli_fetch_assoc($res);
    return $row['avg_rating'] ? round($row['avg_rating'],1) : 0;
}

function isUserEnrolled($conn, $user_id, $course_id){
    $user_id = intval($user_id);
    $course_id = intval($course_id);
    $res = mysqli_query($conn, "SELECT * FROM enrollments WHERE user_id=$user_id AND course_id=$course_id");
    return mysqli_num_rows($res) > 0;
}
?>
