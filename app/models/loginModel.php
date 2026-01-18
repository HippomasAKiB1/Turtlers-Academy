<?php

/**
 * TURTLERS ACADEMY - LOGIN MODEL
 * Handles all database operations for user authentication
 */

// ====================================================
// USER AUTHENTICATION QUERIES
// ====================================================

/**
 * Find user by username or email
 * @param mysqli $conn - Database connection
 * @param string $identifier - Username or email
 * @return array|null - User data or null if not found
 */
function findUserByIdentifier($conn, $identifier) {
    $identifier = mysqli_real_escape_string($conn, $identifier);
    
    $query = "SELECT id, username, full_name, email, password, role 
              FROM users 
              WHERE username = '$identifier' OR email = '$identifier' 
              LIMIT 1";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        return null;
    }
    
    return mysqli_fetch_assoc($result);
}

/**
 * Find user by ID
 * @param mysqli $conn - Database connection
 * @param int $user_id - User ID
 * @return array|null - User data or null if not found
 */
function findUserById($conn, $user_id) {
    $user_id = intval($user_id);
    
    $query = "SELECT id, username, full_name, email, role 
              FROM users 
              WHERE id = $user_id 
              LIMIT 1";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        return null;
    }
    
    return mysqli_fetch_assoc($result);
}

/**
 * Verify user password
 * @param string $password - Plain text password
 * @param string $hash - Password hash from database
 * @return bool - True if password matches
 */
function verifyPassword($password, $hash) {
    // For development: plain text comparison
    // For production: use password_verify($password, $hash)
    if (password_verify($password, $hash)) {
        return true;
    }
    
    // Fallback for plain text passwords (development)
    return $password === $hash;
}

/**
 * Log user login attempt
 * @param mysqli $conn - Database connection
 * @param int $user_id - User ID
 * @param bool $success - Success status
 * @param string $ip_address - IP address
 * @return bool - True if logged successfully
 */
function logLoginAttempt($conn, $user_id, $success, $ip_address = null) {
    if (!$ip_address) {
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
    
    $user_id = intval($user_id);
    $success = $success ? 1 : 0;
    $ip_address = mysqli_real_escape_string($conn, $ip_address);
    
    // Note: You may want to create a login_attempts table for this
    // For now, we'll just track in error logs
    error_log("Login attempt for user_id: $user_id, success: $success, IP: $ip_address");
    
    return true;
}

// ====================================================
// USER VALIDATION QUERIES
// ====================================================

/**
 * Check if username already exists
 * @param mysqli $conn - Database connection
 * @param string $username - Username to check
 * @return bool - True if exists, false otherwise
 */
function usernameExists($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    return mysqli_num_rows($result) > 0;
}

/**
 * Check if email already exists
 * @param mysqli $conn - Database connection
 * @param string $email - Email to check
 * @return bool - True if exists, false otherwise
 */
function emailExists($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    return mysqli_num_rows($result) > 0;
}

// ====================================================
// RATE LIMITING
// ====================================================

/**
 * Check if login is rate limited
 * @param string $identifier - Username or email
 * @param int $max_attempts - Maximum attempts allowed
 * @param int $time_window - Time window in seconds
 * @return bool - True if rate limited, false otherwise
 */
function isLoginRateLimited($identifier, $max_attempts = 5, $time_window = 900) {
    // Store attempts in session
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    $current_time = time();
    
    // Clean old attempts
    if (isset($_SESSION['login_attempts'][$identifier])) {
        $_SESSION['login_attempts'][$identifier] = array_filter(
            $_SESSION['login_attempts'][$identifier],
            function($time) use ($current_time, $time_window) {
                return $current_time - $time < $time_window;
            }
        );
    }
    
    // Check if rate limited
    if (isset($_SESSION['login_attempts'][$identifier])) {
        return count($_SESSION['login_attempts'][$identifier]) >= $max_attempts;
    }
    
    return false;
}

/**
 * Record failed login attempt
 * @param string $identifier - Username or email
 * @return void
 */
function recordFailedLoginAttempt($identifier) {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }
    
    if (!isset($_SESSION['login_attempts'][$identifier])) {
        $_SESSION['login_attempts'][$identifier] = [];
    }
    
    $_SESSION['login_attempts'][$identifier][] = time();
}

/**
 * Clear login attempts
 * @param string $identifier - Username or email
 * @return void
 */
function clearLoginAttempts($identifier) {
    if (isset($_SESSION['login_attempts'][$identifier])) {
        unset($_SESSION['login_attempts'][$identifier]);
    }
}

?>
