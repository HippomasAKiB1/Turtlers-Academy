<?php
$db = mysqli_connect("localhost", "root", "", "turtlers_academy");

if (!$db) {
    die("Connection error: " . mysqli_connect_error());
}

function getManagementCourses($db) {
    $sql = "SELECT * FROM course ORDER BY id DESC";
    $res = mysqli_query($db, $sql);
    $all = array();
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $all[] = $row;
        }
    }
    return $all;
}

function getCourseById($db, $id) {
    $id = intval($id);
    $sql = "SELECT * FROM course WHERE id = $id";
    $res = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($res);
}

function addCourse($db, $code, $name, $tutor, $desc, $img) {
    $code = mysqli_real_escape_string($db, $code);
    $name = mysqli_real_escape_string($db, $name);
    $tutor = mysqli_real_escape_string($db, $tutor);
    $desc = mysqli_real_escape_string($db, $desc);
    $img = mysqli_real_escape_string($db, $img);

    $sql = "INSERT INTO course (course_code, course_name, instructor_name, description, course_image) 
            VALUES ('$code', '$name', '$tutor', '$desc', '$img')";
    return mysqli_query($db, $sql);
}

function updateCourseWithImage($db, $id, $code, $name, $tutor, $desc, $img) {
    $id = intval($id);
    $code = mysqli_real_escape_string($db, $code);
    $name = mysqli_real_escape_string($db, $name);
    $tutor = mysqli_real_escape_string($db, $tutor);
    $desc = mysqli_real_escape_string($db, $desc);
    $img = mysqli_real_escape_string($db, $img);

    $sql = "UPDATE course SET course_code='$code', course_name='$name', instructor_name='$tutor', description='$desc', course_image='$img' WHERE id=$id";
    return mysqli_query($db, $sql);
}

function updateCourse($db, $id, $code, $name, $tutor, $desc) {
    $id = intval($id);
    $code = mysqli_real_escape_string($db, $code);
    $name = mysqli_real_escape_string($db, $name);
    $tutor = mysqli_real_escape_string($db, $tutor);
    $desc = mysqli_real_escape_string($db, $desc);

    $sql = "UPDATE course SET course_code='$code', course_name='$name', instructor_name='$tutor', description='$desc' WHERE id=$id";
    return mysqli_query($db, $sql);
}

function deleteCourse($db, $id) {
    $id = intval($id);
    $sql = "DELETE FROM course WHERE id = $id";
    return mysqli_query($db, $sql);
}
