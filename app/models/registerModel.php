<?php

/**
 * TURTLERS ACADEMY - REGISTER MODEL
 * Handles all database operations for user registration
 */

// ====================================================
// USER REGISTRATION QUERIES
// ====================================================

/**
 * Create new user account
 * @param mysqli $conn - Database connection
 * @param array $user_data - User data array
 * @return int|bool - User ID on success, false on failure
 */
function createUser($conn, $user_data) {
    $username = mysqli_real_escape_string($conn, $user_data['username']);
    $email = mysqli_real_escape_string($conn, $user_data['email']);
    $full_name = mysqli_real_escape_string($conn, $user_data['full_name']);
    $password = mysqli_real_escape_string($conn, $user_data['password']);
    $role = mysqli_real_escape_string($conn, $user_data['role'] ?? 'student');
    
    // For production: use password_hash()
    // For development: store plain text
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $hashed_password = $password;
    
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO users (username, email, full_name, password, role, created_at, updated_at)
              VALUES ('$username', '$email', '$full_name', '$hashed_password', '$role', '$created_at', '$updated_at')";
    
    if (mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn);
    }
    
    return false;
}

/**
 * Get user by username
 * @param mysqli $conn - Database connection
 * @param string $username - Username to find
 * @return array|null - User data or null
 */
function getUserByUsername($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Get user by email
 * @param mysqli $conn - Database connection
 * @param string $email - Email to find
 * @return array|null - User data or null
 */
function getUserByEmail($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

// ====================================================
// VALIDATION QUERIES
// ====================================================

/**
 * Check if username is available
 * @param mysqli $conn - Database connection
 * @param string $username - Username to check
 * @return bool - True if available, false if taken
 */
function isUsernameAvailable($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    return mysqli_num_rows($result) === 0;
}

/**
 * Check if email is available
 * @param mysqli $conn - Database connection
 * @param string $email - Email to check
 * @return bool - True if available, false if taken
 */
function isEmailAvailable($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    return mysqli_num_rows($result) === 0;
}

// ====================================================
// PROFILE CREATION
// ====================================================

/**
 * Create student profile
 * @param mysqli $conn - Database connection
 * @param int $user_id - User ID
 * @param string $institution - Institution name
 * @return bool - True on success
 */
function createStudentProfile($conn, $user_id, $institution = '') {
    $user_id = intval($user_id);
    $institution = mysqli_real_escape_string($conn, $institution);
    $created_at = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO students (user_id, institution, created_at)
              VALUES ($user_id, '$institution', '$created_at')";
    
    return mysqli_query($conn, $query);
}

/**
 * Create instructor profile
 * @param mysqli $conn - Database connection
 * @param int $user_id - User ID
 * @param string $bio - Instructor bio
 * @param string $institution - Institution name
 * @return bool - True on success
 */
function createInstructorProfile($conn, $user_id, $bio = '', $institution = '') {
    $user_id = intval($user_id);
    $bio = mysqli_real_escape_string($conn, $bio);
    $institution = mysqli_real_escape_string($conn, $institution);
    $created_at = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO instructors (user_id, bio, institution, created_at)
              VALUES ($user_id, '$bio', '$institution', '$created_at')";
    
    return mysqli_query($conn, $query);
}

?>
