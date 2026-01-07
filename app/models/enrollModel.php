<?php
function enrollUser($conn, $user_id, $course_id, $name, $email, $phone)
{
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    return mysqli_query($conn, "
        INSERT INTO enrollments (user_id, course_id, full_name, email, phone)
        VALUES ('$user_id','$course_id','$name','$email','$phone')
    ");
}

function isAlreadyEnrolled($conn, $user_id, $course_id)
{
    $check = mysqli_query($conn, "
        SELECT id FROM enrollments 
        WHERE user_id='$user_id' AND course_id='$course_id'
    ");
    if (!$check)
        return false;
    return mysqli_num_rows($check) > 0;
}
