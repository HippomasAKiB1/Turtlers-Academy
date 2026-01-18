<?php

/**
 * TURTLERS ACADEMY - REGISTER CONTROLLER
 * Handles user registration and account creation
 */

require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/registerModel.php";
require_once __DIR__ . "/../models/loginModel.php";

// ====================================================
// VALIDATION FUNCTIONS
// ====================================================

/**
 * Validate username for registration
 * @param string $username - Username to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateRegisterUsername($username) {
    if (empty($username)) {
        return ['valid' => false, 'error' => 'Username is required'];
    }

    if (strlen($username) < 3) {
        return ['valid' => false, 'error' => 'Username must be at least 3 characters'];
    }

    if (strlen($username) > 50) {
        return ['valid' => false, 'error' => 'Username cannot exceed 50 characters'];
    }

    if (!preg_match('/^[a-zA-Z0-9_.]+$/', $username)) {
        return ['valid' => false, 'error' => 'Username can only contain letters, numbers, dots, and underscores'];
    }

    // Check if username already exists
    global $conn;
    if (!isUsernameAvailable($conn, $username)) {
        return ['valid' => false, 'error' => 'Username already taken'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate email for registration
 * @param string $email - Email to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateRegisterEmail($email) {
    if (empty($email)) {
        return ['valid' => false, 'error' => 'Email is required'];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['valid' => false, 'error' => 'Please enter a valid email address'];
    }

    if (strlen($email) > 100) {
        return ['valid' => false, 'error' => 'Email cannot exceed 100 characters'];
    }

    // Check if email already exists
    global $conn;
    if (!isEmailAvailable($conn, $email)) {
        return ['valid' => false, 'error' => 'Email already registered'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate full name
 * @param string $full_name - Full name to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateFullName($full_name) {
    if (empty($full_name)) {
        return ['valid' => false, 'error' => 'Full name is required'];
    }

    if (strlen($full_name) < 3) {
        return ['valid' => false, 'error' => 'Full name must be at least 3 characters'];
    }

    if (strlen($full_name) > 100) {
        return ['valid' => false, 'error' => 'Full name cannot exceed 100 characters'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate password for registration
 * @param string $password - Password to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateRegisterPassword($password) {
    if (empty($password)) {
        return ['valid' => false, 'error' => 'Password is required'];
    }

    if (strlen($password) < 6) {
        return ['valid' => false, 'error' => 'Password must be at least 6 characters'];
    }

    if (strlen($password) > 100) {
        return ['valid' => false, 'error' => 'Password cannot exceed 100 characters'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate password confirmation
 * @param string $password - Password
 * @param string $password_confirm - Password confirmation
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validatePasswordMatch($password, $password_confirm) {
    if ($password !== $password_confirm) {
        return ['valid' => false, 'error' => 'Passwords do not match'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate account type selection
 * @param string $role - User role
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateAccountType($role) {
    if (empty($role)) {
        return ['valid' => false, 'error' => 'Please select an account type'];
    }

    $valid_roles = ['student', 'instructor'];
    if (!in_array($role, $valid_roles)) {
        return ['valid' => false, 'error' => 'Invalid account type'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate complete registration form
 * @param array $data - Form data
 * @return array - ['valid' => bool, 'errors' => array]
 */
function validateRegistrationForm($data) {
    $errors = [];

    $usernameValidation = validateRegisterUsername($data['username'] ?? '');
    if (!$usernameValidation['valid']) {
        $errors['username'] = $usernameValidation['error'];
    }

    $emailValidation = validateRegisterEmail($data['email'] ?? '');
    if (!$emailValidation['valid']) {
        $errors['email'] = $emailValidation['error'];
    }

    $nameValidation = validateFullName($data['full_name'] ?? '');
    if (!$nameValidation['valid']) {
        $errors['full_name'] = $nameValidation['error'];
    }

    $passwordValidation = validateRegisterPassword($data['password'] ?? '');
    if (!$passwordValidation['valid']) {
        $errors['password'] = $passwordValidation['error'];
    }

    $confirmValidation = validatePasswordMatch($data['password'] ?? '', $data['password_confirm'] ?? '');
    if (!$confirmValidation['valid']) {
        $errors['password_confirm'] = $confirmValidation['error'];
    }

    $roleValidation = validateAccountType($data['role'] ?? '');
    if (!$roleValidation['valid']) {
        $errors['role'] = $roleValidation['error'];
    }

    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

// ====================================================
// REGISTRATION FUNCTIONS
// ====================================================

/**
 * Register a new user
 * @param array $data - User data
 * @return array - ['success' => bool, 'user_id' => int|null, 'message' => string]
 */
function registerNewUser($data) {
    global $conn;

    // Validate all form data
    $validation = validateRegistrationForm($data);
    if (!$validation['valid']) {
        return [
            'success' => false,
            'user_id' => null,
            'message' => 'Please correct the errors below',
            'errors' => $validation['errors']
        ];
    }

    // Create user account
    $user_data = [
        'username' => $data['username'],
        'email' => $data['email'],
        'full_name' => $data['full_name'],
        'password' => $data['password'],
        'role' => $data['role']
    ];

    $user_id = createUser($conn, $user_data);

    if (!$user_id) {
        return [
            'success' => false,
            'user_id' => null,
            'message' => 'An error occurred during registration. Please try again.',
            'errors' => []
        ];
    }

    // Create profile based on role
    if ($data['role'] === 'student') {
        createStudentProfile($conn, $user_id, $data['institution'] ?? '');
    } elseif ($data['role'] === 'instructor') {
        createInstructorProfile($conn, $user_id, $data['bio'] ?? '', $data['institution'] ?? '');
    }

    return [
        'success' => true,
        'user_id' => $user_id,
        'message' => 'Registration successful! You can now log in.',
        'errors' => []
    ];
}

// ====================================================
// HANDLE REGISTRATION REQUEST
// ====================================================

$registerResponse = [
    'success' => false,
    'message' => '',
    'user_id' => null,
    'errors' => []
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_data = [
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'full_name' => $_POST['full_name'] ?? '',
        'password' => $_POST['password'] ?? '',
        'password_confirm' => $_POST['password_confirm'] ?? '',
        'role' => $_POST['role'] ?? '',
        'institution' => $_POST['institution'] ?? '',
        'bio' => $_POST['bio'] ?? ''
    ];

    // Register user
    $result = registerNewUser($form_data);

    if (!$result['success']) {
        http_response_code(400);
        $registerResponse['message'] = $result['message'];
        $registerResponse['errors'] = $result['errors'];
        header('Content-Type: application/json');
        echo json_encode($registerResponse);
        exit;
    }

    // Success response
    $registerResponse['success'] = true;
    $registerResponse['message'] = $result['message'];
    $registerResponse['user_id'] = $result['user_id'];

    header('Content-Type: application/json');
    echo json_encode($registerResponse);
    exit;
}

?>
