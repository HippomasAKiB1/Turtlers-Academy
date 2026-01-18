<?php

function getTutorProfile($conn, $username)
{
    
    $username = trim(mysqli_real_escape_string($conn, $username));

    
    $query = "SELECT * FROM users WHERE (username = '$username' OR full_name = '$username') AND role IN ('tutor', 'instructor') LIMIT 1";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);

   

    if (!$user) {
       
        return null;
    }

   

    $tutorName = $user['full_name'];
    $bio = "Turtlers Academy Tutor";

    
    $instQuery = "SELECT * FROM instructors WHERE name = '$tutorName' LIMIT 1";
    $instRes = mysqli_query($conn, $instQuery);
    if ($instRow = mysqli_fetch_assoc($instRes)) {
       
    }

    return [
        "name" => $user['full_name'],
        "institution" => "Turtlers Academy of Tech", 
        // Store relative image path; views will resolve via base href
        "image" => $user['profile_pic'] ?? "assets/images/tutor.png",
        "id" => $user['id']
    ];
}

function getCourseByTutor($conn, $tutor_name)
{
  
    $tutor_name = mysqli_real_escape_string($conn, $tutor_name);
    $query = "SELECT * FROM courses WHERE instructor_name = '$tutor_name' LIMIT 1";
    $res = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($res);
}

function getEnrolledStudentsForCourse($conn, $course_id)
{
    $course_id = intval($course_id);
   
    $query = "
        SELECT u.id, u.full_name as name, u.email, c.course_name as course
        FROM enrollments e
        JOIN users u ON e.user_id = u.id
        JOIN courses c ON e.course_id = c.id
        WHERE e.course_id = $course_id AND (e.status = 'active' OR e.status = '' OR e.status IS NULL)
    ";

    $res = mysqli_query($conn, $query);
    $students = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $students[] = $row;
    }
    return $students;
}

function getAllStudentsWithCourses($conn)
{
    

    $query = "
        SELECT u.id, u.full_name as name, u.email, COALESCE(c.course_name, 'Not Enrolled') as course
        FROM users u
        LEFT JOIN enrollments e ON u.id = e.user_id AND (e.status = 'active' OR e.status = '' OR e.status IS NULL)
        LEFT JOIN courses c ON e.course_id = c.id
        WHERE u.role = 'student'
        ORDER BY u.id ASC
    ";

    $res = mysqli_query($conn, $query);
    $students = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $students[] = $row;
    }
    return $students;
}

function getAllTutors($conn)
{
    $sql = "SELECT id, fullname, email FROM users LIMIT 4";
    $res = mysqli_query($conn, $sql);

    $tutors = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $tutors[] = $row;
        }
    }
    return $tutors;
}
