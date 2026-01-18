<?php



//session_start();

require_once __DIR__ . "/../../core/database.php";
require_once __DIR__ . "/../models/loginModel.php";


/**
 * Validate username input
 * @param string $username - Username to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validateUsername($username) {
    if (empty($username)) {
        return ['valid' => false, 'error' => 'Username is required'];
    }

    if (strlen($username) < 3) {
        return ['valid' => false, 'error' => 'Username must be at least 3 characters'];
    }

    if (strlen($username) > 100) {
        return ['valid' => false, 'error' => 'Username cannot exceed 100 characters'];
    }

    // Allow alphanumeric, underscore, and dot
    if (!preg_match('/^[a-zA-Z0-9_.]+$/', $username)) {
        return ['valid' => false, 'error' => 'Username can only contain letters, numbers, dots, and underscores'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate password input
 * @param string $password - Password to validate
 * @return array - ['valid' => bool, 'error' => string|null]
 */
function validatePassword($password) {
    if (empty($password)) {
        return ['valid' => false, 'error' => 'Password is required'];
    }

    if (strlen($password) < 6) {
        return ['valid' => false, 'error' => 'Password must be at least 6 characters'];
    }

    return ['valid' => true, 'error' => null];
}

/**
 * Validate login form data
 * @param string $username - Username
 * @param string $password - Password
 * @return array - ['valid' => bool, 'errors' => array]
 */
function validateLoginForm($username, $password) {
    $errors = [];

    $usernameValidation = validateUsername($username);
    if (!$usernameValidation['valid']) {
        $errors['username'] = $usernameValidation['error'];
    }

    $passwordValidation = validatePassword($password);
    if (!$passwordValidation['valid']) {
        $errors['password'] = $passwordValidation['error'];
    }

    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

// ====================================================
// AUTHENTICATION FUNCTIONS
// ====================================================

/**
 * Authenticate user with username and password
 * @param string $username - Username or email
 * @param string $password - Password (plain text)
 * @return array - ['success' => bool, 'user' => array|null, 'error' => string|null]
 */
function authenticateUser($username, $password) {
    global $conn;

    // Find user by identifier (username or email)
    $user = findUserByIdentifier($conn, $username);

    // User not found
    if (!$user) {
        recordFailedLoginAttempt($username);
        return [
            'success' => false,
            'user' => null,
            'error' => 'Invalid username or email'
        ];
    }

    // Verify password using model function
    if (!verifyPassword($password, $user['password'])) {
        recordFailedLoginAttempt($username);
        return [
            'success' => false,
            'user' => null,
            'error' => 'Invalid password'
        ];
    }

    // Clear login attempts on success
    clearLoginAttempts($username);

    return [
        'success' => true,
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role']
        ],
        'error' => null
    ];
}

/**
 * Create user session
 * @param array $user - User data
 * @return void
 */
function createUserSession($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['login_time'] = time();
    $_SESSION['logged_in'] = true;
}

/**
 * Destroy user session (logout)
 * @return void
 */
function destroyUserSession() {
    session_destroy();
    $_SESSION = [];
}

/**
 * Check if user is logged in
 * @return bool - True if logged in, false otherwise
 */
function isUserLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Get current logged in user
 * @return array|null - User data or null if not logged in
 */
function getCurrentUser() {
    if (!isUserLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'full_name' => $_SESSION['full_name'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'role' => $_SESSION['role'] ?? null
    ];
}

// ====================================================
// HANDLE LOGIN REQUEST
// ====================================================

$loginResponse = [
    'success' => false,
    'message' => '',
    'redirect' => null,
    'errors' => []
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate form data
    $validation = validateLoginForm($username, $password);

    if (!$validation['valid']) {
        http_response_code(400);
        $loginResponse['errors'] = $validation['errors'];
        $loginResponse['message'] = 'Please correct the errors below';
        header('Content-Type: application/json');
        echo json_encode($loginResponse);
        exit;
    }

    // Authenticate user
    $authResult = authenticateUser($username, $password);

    if (!$authResult['success']) {
        http_response_code(401);
        $loginResponse['message'] = $authResult['error'];
        header('Content-Type: application/json');
        echo json_encode($loginResponse);
        exit;
    }

    // Create session
    createUserSession($authResult['user']);

    // Success response
    $loginResponse['success'] = true;
    $loginResponse['message'] = 'Login successful!';
    // Redirect to public index using relative path; client will resolve relative to the public folder
    $loginResponse['redirect'] = 'index.php';

    header('Content-Type: application/json');
    echo json_encode($loginResponse);
    exit;
}

// Check if user is already logged in
if (isUserLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Include login view
include __DIR__ . "/../views/login/loginPage.php";

?>