<?php
require_once "../models/AdminCourseModel.php";

if(isset($_POST['add_course'])) {
    $code = $_POST['course_code'];
    $name = $_POST['course_name'];
    $instructor = $_POST['instructor_name'];
    $desc = $_POST['description'];
    
    $image = "default.png";
    if(!empty($_FILES['course_image']['name'])) {
        $image = time() . "_" . $_FILES['course_image']['name'];
        move_uploaded_file($_FILES['course_image']['tmp_name'], "../../public/assets/upload/" . $image);
    }
    
    addCourse($db, $code, $name, $instructor, $desc, $image);
    
    header("Location: ../views/course_dashboard/dashboard.php?msg=Course Added");
    exit();
}


if(isset($_POST['update_course'])) {
    $id = $_POST['course_id'];
    $code = $_POST['course_code'];
    $name = $_POST['course_name'];
    $instructor = $_POST['instructor_name'];
    $desc = $_POST['description'];
    
    if(!empty($_FILES['course_image']['name'])) {
        $image = time() . "_" . $_FILES['course_image']['name'];
        move_uploaded_file($_FILES['course_image']['tmp_name'], "../../public/assets/upload/" . $image);
        
        updateCourseWithImage($db, $id, $code, $name, $instructor, $desc, $image);
    } else {
        updateCourse($db, $id, $code, $name, $instructor, $desc);
    }
    
    header("Location: ../views/course_dashboard/dashboard.php?msg=Course Updated");
    exit();
}


if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    deleteCourse($db, $id);
    
    header("Location: ../views/course_dashboard/dashboard.php?msg=Course Deleted");
    exit();
}

?>