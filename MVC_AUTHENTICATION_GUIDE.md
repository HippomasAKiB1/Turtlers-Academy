# Turtlers Academy - Complete MVC Authentication System

## Overview

The authentication system follows proper **MVC (Model-View-Controller)** architecture with complete separation of concerns:

- **Models**: Handle database operations and queries
- **Controllers**: Manage business logic and validation
- **Views**: Display user interfaces
- **Public**: Entry points for users

---

## Directory Structure

```
app/
├── controllers/
│   ├── loginController.php         # Login logic & session management
│   └── registerController.php       # Registration logic & validation
├── models/
│   ├── loginModel.php              # Database queries for login
│   └── registerModel.php            # Database queries for registration
└── views/
    ├── login/
    │   └── loginPage.php           # Login form UI
    └── register/
        └── registerPage.php         # Registration form UI

public/
├── login.php                        # Login entry point
├── register.php                     # Registration entry point
└── assets/
    ├── css/
    │   ├── login.css               # Login page styling
    │   └── register.css             # Registration page styling
    └── js/
        ├── login.js                 # Login form handling
        └── register.js              # Registration form handling

app/actions/
└── logout.php                       # Logout action

app/partials/
└── header.php                       # Navigation with auth buttons
```

---

## File Descriptions

### 1. **loginModel.php** (Model)
Database operations for authentication:

**Functions:**
- `findUserByIdentifier($conn, $identifier)` - Find user by username or email
- `findUserById($conn, $user_id)` - Find user by ID
- `verifyPassword($password, $hash)` - Verify password against hash
- `usernameExists($conn, $username)` - Check if username is taken
- `emailExists($conn, $email)` - Check if email is taken
- `isLoginRateLimited($identifier)` - Check for too many login attempts
- `recordFailedLoginAttempt($identifier)` - Track failed attempts
- `clearLoginAttempts($identifier)` - Clear attempt counter
- `logLoginAttempt($conn, $user_id, $success, $ip_address)` - Log attempts

### 2. **registerModel.php** (Model)
Database operations for user registration:

**Functions:**
- `createUser($conn, $user_data)` - Create new user account
- `getUserByUsername($conn, $username)` - Get user data by username
- `getUserByEmail($conn, $email)` - Get user data by email
- `isUsernameAvailable($conn, $username)` - Check username availability
- `isEmailAvailable($conn, $email)` - Check email availability
- `createStudentProfile($conn, $user_id, $institution)` - Create student profile
- `createInstructorProfile($conn, $user_id, $bio, $institution)` - Create instructor profile

### 3. **loginController.php** (Controller)
Business logic for login:

**Functions:**
- `validateUsername($username)` - Validate username format
- `validatePassword($password)` - Validate password requirements
- `validateLoginForm($username, $password)` - Validate complete form
- `authenticateUser($username, $password)` - Authenticate against database
- `createUserSession($user)` - Create session after login
- `destroyUserSession()` - Logout user
- `isUserLoggedIn()` - Check if user has active session
- `getCurrentUser()` - Get logged-in user data

**Handles POST requests** to `/app/controllers/loginController.php`

### 4. **registerController.php** (Controller)
Business logic for registration:

**Functions:**
- `validateRegisterUsername($username)` - Validate username (3-50 chars, unique)
- `validateRegisterEmail($email)` - Validate email format and availability
- `validateFullName($full_name)` - Validate name (3+ chars)
- `validateRegisterPassword($password)` - Validate password (6+ chars)
- `validatePasswordMatch($password, $password_confirm)` - Verify password match
- `validateAccountType($role)` - Validate role selection
- `validateRegistrationForm($data)` - Validate entire form
- `registerNewUser($data)` - Create new user account and profile

**Handles POST requests** to `/app/controllers/registerController.php`

### 5. **loginPage.php** (View)
Login form user interface:

**Features:**
- Username/email input field
- Password input field
- Remember me checkbox
- Forgot password link
- Error/success alerts
- Sign up link (redirects to register)
- Side panel with benefits
- Responsive design

### 6. **registerPage.php** (View)
Registration form user interface:

**Features:**
- Account type selection (Student/Instructor radio buttons)
- Full name input
- Username input with availability feedback
- Email input
- Institution field (optional)
- Bio field (instructor-only, shows/hides based on role)
- Password input
- Password confirmation
- Error/success alerts
- Sign in link
- Side panel with community benefits
- Responsive design

### 7. **login.php** (Public Entry Point)
Serves as the public gateway to login:

```php
// Redirects logged-in users to home
// Includes loginController.php
// Includes loginPage.php view
```

### 8. **register.php** (Public Entry Point)
Serves as the public gateway to registration:

```php
// Redirects logged-in users to home
// Includes registerController.php
// Includes registerPage.php view
```

### 9. **login.css** (Styling)
Complete styling for login page:
- Two-column layout (form on left, illustration on right)
- Mobile-responsive (collapses to single column)
- Form styling with focus states
- Error message styling
- Loading spinner animation
- Smooth transitions and animations

### 10. **register.css** (Styling)
Complete styling for registration page:
- Two-column layout
- Account type selection with visual indicators
- Form styling with error states
- Responsive benefits grid
- Mobile-optimized layout
- Loading animations

### 11. **login.js** (Client-side Logic)
Form handling and validation:

**Functions:**
- `validateForm(form)` - Validate all fields
- `validateField(field)` - Validate individual field
- `showFieldError(field, message)` - Display field error
- `clearFieldError(field)` - Clear field error
- `showError(message)` - Show alert error
- `showSuccess(message)` - Show alert success
- `showLoading(form)` - Show loading state
- `hideLoading(form)` - Hide loading state
- `handleFormSubmit(e)` - Handle form submission

**Features:**
- Real-time validation on blur
- Field error highlighting
- AJAX form submission
- Loading spinner during request
- Redirect on success

### 12. **register.js** (Client-side Logic)
Form handling and validation:

**Additional Features:**
- Show/hide bio field based on role selection
- Password match validation
- Real-time field validation
- AJAX submission to registerController
- Success redirects to login page
- Field-specific error display

### 13. **logout.php** (Action)
Handles user logout:
```php
// Destroys session
// Clears session array
// Redirects to home
```

### 14. **header.php** (Navigation)
Updated to show:
- **For Guests**: "Log In" button + "Sign Up" button
- **For Logged-in Users**: User avatar + name + role + "Log Out" button

---

## Data Flow

### Login Flow

```
User visits /login.php
    ↓
Login form displayed (loginPage.php)
    ↓
User enters username/email and password
    ↓
JavaScript validates client-side (login.js)
    ↓
AJAX POST to loginController.php
    ↓
loginController validates:
  - Calls validateLoginForm()
  - Calls authenticateUser()
    - Uses loginModel to find user (findUserByIdentifier)
    - Uses loginModel to verify password (verifyPassword)
  - Records attempt (recordFailedLoginAttempt or clearLoginAttempts)
    ↓
If successful:
  - Creates session (createUserSession)
  - Returns JSON with redirect URL
  - JavaScript redirects to home
    ↓
If failed:
  - Returns JSON with error message
  - JavaScript displays error alert
  - User can retry
```

### Registration Flow

```
User visits /register.php
    ↓
Registration form displayed (registerPage.php)
    ↓
User selects account type (Student/Instructor)
    ↓
User fills form (name, username, email, password, etc.)
    ↓
JavaScript validates client-side (register.js):
  - All fields present
  - Passwords match
  - Format validation (email, username, etc.)
    ↓
AJAX POST to registerController.php
    ↓
registerController validates:
  - Calls validateRegistrationForm()
  - Checks each field:
    - Username (3-50 chars, unique, alphanumeric only)
    - Email (valid format, unique)
    - Full name (3+ chars)
    - Password (6+ chars)
    - Password confirmation (must match)
    - Account type (student or instructor)
    ↓
If validation fails:
  - Returns errors for each field
  - JavaScript displays field-specific errors
  - User corrects and resubmits
    ↓
If validation succeeds:
  - registerModel creates user (createUser)
  - Creates profile based on role:
    - Student: createStudentProfile
    - Instructor: createInstructorProfile
  - Returns success message
  - JavaScript shows success alert
  - After 2 seconds, redirects to login
    ↓
User can now login with new credentials
```

---

## Authentication Features

### Client-side Validation
- Real-time validation on field blur
- Error messages appear below fields
- Field highlighting on error
- Form submission prevented if invalid

### Server-side Validation
- All inputs sanitized with `mysqli_real_escape_string()`
- All inputs validated with specific rules
- Duplicate prevention (username/email checks)
- Password requirements enforced
- Role validation

### Security Features
- Session-based authentication with `$_SESSION`
- Sanitized user inputs
- Secure password handling (plain text for development, should use `password_hash()` for production)
- Error messages don't expose user existence ("Invalid username or email" rather than "User not found")
- Rate limiting support for login attempts

### Session Management
Session variables stored:
```php
$_SESSION['user_id']      // User ID from database
$_SESSION['username']     // Username
$_SESSION['full_name']    // Full name
$_SESSION['email']        // Email address
$_SESSION['role']         // User role (student/instructor/admin)
$_SESSION['login_time']   // Login timestamp
$_SESSION['logged_in']    // Boolean flag
```

---

## Testing the System

### Test Users (from Sample Data)

**Student:**
- Username: `student1`
- Password: `password123`

**Instructor:**
- Username: `instructor1`
- Password: `password123`

### Test Registration

1. Go to `/register.php`
2. Select "Student" or "Instructor"
3. Fill all required fields:
   - Full Name: `John Doe`
   - Username: `johndoe` (must be unique)
   - Email: `john@example.com` (must be unique)
   - Password: `testpass123`
   - Confirm Password: `testpass123`
4. Submit form
5. Should see success message
6. Should redirect to login
7. Login with new credentials

### Test Login

1. Go to `/login.php`
2. Enter `student1` and `password123`
3. Should see success message
4. Should redirect to home
5. Header should show user info instead of login button

### Test Logout

1. While logged in, click "Log Out" button
2. Should redirect to home
3. Header should show "Log In" and "Sign Up" buttons again

---

## Common Error Messages

| Error | Cause | Solution |
|-------|-------|----------|
| Username must be at least 3 characters | Username too short | Use 3+ characters |
| Username already taken | Username exists | Choose different username |
| Please enter a valid email address | Invalid email format | Check email format |
| Email already registered | Email exists | Use different email or login |
| Passwords do not match | Confirmation doesn't match | Re-enter same password |
| Invalid username or email | User not found | Check username/email, or register |
| Invalid password | Wrong password | Check caps lock, re-enter password |

---

## Customization Guide

### Change Primary Color

Edit `login.css` and `register.css`:
```css
:root {
    --primary-color: #ff7b00;    /* Change this */
    --primary-dark: #e06a00;      /* And this */
}
```

### Add Password Hashing

Update `registerController.php` line 210:
```php
// Change from:
$hashed_password = $password;

// To:
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
```

Update `loginModel.php` line 47:
```php
// Already supports this:
if (password_verify($password, $hash)) {
    return true;
}
```

### Add Email Verification

1. Create `email_verification.php` in models
2. Generate verification token in `registerController.php`
3. Send email with verification link
4. Create verification page to confirm email
5. Only allow login after verification

### Add "Remember Me"

1. Create cookie in `loginController.php`:
```php
if ($_POST['remember_me']) {
    setcookie('user_id', $user['id'], time() + (30 * 24 * 60 * 60));
    setcookie('username', $user['username'], time() + (30 * 24 * 60 * 60));
}
```

2. Check for cookies on page load:
```php
if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
    // Auto-login user from cookie
}
```

### Add Password Reset

1. Create `forgot-password.php` view
2. Create `resetController.php` with token generation
3. Create password reset email
4. Create reset form page
5. Update password in database

---

## Security Notes

### For Development ✓
Current implementation is suitable for development/testing:
- Plain text password storage
- Basic rate limiting
- Simple validation

### For Production ⚠️
Before deploying, implement:
- ✓ Use `password_hash()` for password storage
- ✓ Use `password_verify()` for password checking
- ✓ Add CSRF tokens to forms
- ✓ Use HTTPS only
- ✓ Add comprehensive rate limiting
- ✓ Implement email verification
- ✓ Add password reset functionality
- ✓ Use prepared statements everywhere
- ✓ Add security headers
- ✓ Add login attempt logging
- ✓ Implement account lockout after N failed attempts

---

## Next Steps

1. **Password Hashing**: Implement `password_hash()` for production
2. **Email Verification**: Verify email before account activation
3. **Password Reset**: Add forgot password functionality
4. **Two-Factor Authentication**: Add SMS/email OTP
5. **Social Login**: Add Google/GitHub login
6. **User Profile**: Create profile edit page
7. **Dashboard**: Create user dashboard with courses

---

## Troubleshooting

### User can't login
- Check if credentials are correct (case-sensitive)
- Verify user exists in database
- Check if session is enabled in PHP

### Registration fails silently
- Open browser console (F12) to see JavaScript errors
- Check network tab in DevTools for response
- Verify database tables exist (users, students, instructors)

### Session data not persisting
- Check if `session_start()` is called
- Verify cookies are enabled
- Check session.save_path in php.ini

### Validation errors appearing
- Clear browser cache
- Check browser console for JavaScript errors
- Verify CSS/JS files load correctly

---

## API Reference

### Login Endpoint
```
POST /app/controllers/loginController.php
Content-Type: application/x-www-form-urlencoded

Parameters:
- username (string): Username or email
- password (string): Password

Response:
{
    "success": true/false,
    "message": "Login successful!",
    "redirect": "/Turtlers-Academy/public/index.php",
    "errors": {}
}
```

### Register Endpoint
```
POST /app/controllers/registerController.php
Content-Type: application/x-www-form-urlencoded

Parameters:
- username (string): 3-50 chars, alphanumeric + _ .
- email (string): Valid email format
- full_name (string): 3+ characters
- password (string): 6+ characters
- password_confirm (string): Must match password
- role (string): 'student' or 'instructor'
- institution (string, optional): School/org name
- bio (string, optional): For instructors only

Response:
{
    "success": true/false,
    "message": "Registration successful!",
    "user_id": 123,
    "errors": {
        "username": "Username already taken",
        "email": "Please enter a valid email"
    }
}
```

---

## Support

For issues or questions:
1. Check browser console for errors
2. Check server error logs
3. Verify database connections
4. Ensure all files are in correct folders
5. Test with provided sample data first

---

**Last Updated:** January 2026
**Version:** 2.0 - Complete MVC Implementation
