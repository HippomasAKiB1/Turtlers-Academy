<?php
// tutorModel.php
// Fetch tutors from users table


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
