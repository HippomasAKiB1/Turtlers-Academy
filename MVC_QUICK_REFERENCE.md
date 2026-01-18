# MVC Architecture - Quick Reference

## What is MVC?

**MVC (Model-View-Controller)** separates code into three logical layers:

```
┌─────────────────────────────────────────────────────┐
│                      USER                            │
└────────────────────┬────────────────────────────────┘
                     │
┌─────────────────────────────────────────────────────┐
│                    VIEW                              │
│  (loginPage.php, registerPage.php)                  │
│  - User Interface                                    │
│  - Form HTML                                         │
│  - Error/Success Messages                            │
└────────────────────┬────────────────────────────────┘
                     │
                     │ (POST data)
                     ↓
┌─────────────────────────────────────────────────────┐
│                 CONTROLLER                           │
│  (loginController.php, registerController.php)      │
│  - Validation Logic                                  │
│  - Business Rules                                    │
│  - Session Management                                │
└────────────────────┬────────────────────────────────┘
                     │
                     │ (queries)
                     ↓
┌─────────────────────────────────────────────────────┐
│                    MODEL                             │
│  (loginModel.php, registerModel.php)                │
│  - Database Queries                                  │
│  - Data Retrieval/Storage                            │
│  - Database Logic                                    │
└────────────────────┬────────────────────────────────┘
                     │
                     ↓
             ┌───────────────┐
             │   DATABASE    │
             └───────────────┘
```

## File Organization

### Models (app/models/)
**Purpose:** Database operations only

```
loginModel.php:
- findUserByIdentifier()
- verifyPassword()
- usernameExists()
- emailExists()
- etc.

registerModel.php:
- createUser()
- isUsernameAvailable()
- isEmailAvailable()
- createStudentProfile()
- createInstructorProfile()
```

### Views (app/views/)
**Purpose:** User interface only

```
login/loginPage.php:
- HTML form
- Input fields
- Error/success alerts
- Links to register

register/registerPage.php:
- HTML form
- Radio buttons for role
- Input fields
- Optional fields (bio for instructor)
- Links to login
```

### Controllers (app/controllers/)
**Purpose:** Business logic and validation

```
loginController.php:
- validateLoginForm()
- authenticateUser()
- createUserSession()
- destroyUserSession()
- Handles POST requests

registerController.php:
- validateRegistrationForm()
- registerNewUser()
- Handles POST requests
```

### Public Entry Points (public/)
**Purpose:** Gateway to application

```
login.php:
- Includes loginController.php
- Includes loginPage.php view
- Checks if already logged in

register.php:
- Includes registerController.php
- Includes registerPage.php view
- Checks if already logged in
```

### Assets (public/assets/)
**Purpose:** Styling and client-side logic

```
css/login.css
css/register.css
js/login.js
js/register.js
```

## Data Flow Examples

### Example 1: User Registration

```
1. User visits /register.php
   ↓
2. register.php includes registerController.php
   ↓
3. registerController.php loads registerPage.php view
   ↓
4. registerPage.php displays form
   ↓
5. User fills form and submits
   ↓
6. JavaScript (register.js) validates client-side
   ↓
7. AJAX POST to registerController.php
   ↓
8. registerController.php:
   - Calls validateRegistrationForm()
   - Calls registerNewUser()
   ↓
9. registerNewUser() calls registerModel functions:
   - isUsernameAvailable()
   - isEmailAvailable()
   - createUser()
   - createStudentProfile() or createInstructorProfile()
   ↓
10. registerModel executes SQL queries
    ↓
11. Controller returns JSON response
    ↓
12. JavaScript receives response
    ↓
13. If success → show success message → redirect to login
    If failed → show error messages → user corrects
```

### Example 2: User Login

```
1. User visits /login.php
   ↓
2. login.php includes loginController.php
   ↓
3. loginController.php loads loginPage.php view
   ↓
4. loginPage.php displays form
   ↓
5. User enters credentials and submits
   ↓
6. JavaScript (login.js) validates client-side
   ↓
7. AJAX POST to loginController.php
   ↓
8. loginController.php:
   - Calls validateLoginForm()
   - Calls authenticateUser()
   ↓
9. authenticateUser() calls loginModel functions:
   - findUserByIdentifier()
   - verifyPassword()
   - recordFailedLoginAttempt() or clearLoginAttempts()
   ↓
10. loginModel executes SQL query
    ↓
11. If password matches:
    - createUserSession()
    - Return success + redirect URL
    ↓
12. JavaScript redirects to home
    ↓
13. User now logged in (session active)
    ↓
14. header.php shows user info instead of login button
```

## Benefits of MVC

| Benefit | Why It Matters |
|---------|----------------|
| **Separation of Concerns** | Each layer has one job. Easier to understand. |
| **Reusability** | Functions can be used by multiple pages. |
| **Maintainability** | Changes in one layer don't break others. |
| **Testability** | Each layer can be tested independently. |
| **Scalability** | Easy to add features without breaking existing code. |
| **Team Development** | Developers can work on different layers simultaneously. |

## MVC vs Non-MVC

### ❌ Non-MVC (Messy)
```php
<?php
    $conn = mysqli_connect(...);
    
    if ($_POST) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // HTML, validation, and database all mixed!
        if (!$username) {
            echo "Username required";
        }
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        
        echo "<form>...";
        $_SESSION['user'] = $username;
    }
?>
<form method="POST">
    <!-- HTML in PHP -->
</form>
```

### ✓ MVC (Clean)
```
File 1: loginModel.php
- findUserByIdentifier()
- verifyPassword()

File 2: loginController.php
- validateLoginForm()
- authenticateUser()
- createUserSession()

File 3: loginPage.php
- HTML form only
- No database code
- No validation code

File 4: login.php (Public)
- Includes controller
- Includes view
```

## When to Use Each Layer

| Layer | Examples |
|-------|----------|
| **Model** | Database queries, calculations, data transformations |
| **Controller** | Validation, business logic, session management |
| **View** | HTML, form inputs, error displays, CSS classes |
| **Public** | Entry point, routing, file includes |

## Common Mistakes

### ❌ Database queries in View
```php
<!-- WRONG - In loginPage.php -->
<?php
    $result = mysqli_query($conn, "SELECT * FROM users");
?>
```

### ✓ Database queries in Model
```php
// RIGHT - In loginModel.php
function findUserByIdentifier($conn, $identifier) {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = ...");
    return mysqli_fetch_assoc($result);
}
```

### ❌ HTML in Controller
```php
// WRONG - In loginController.php
echo "<form>...";
```

### ✓ HTML in View only
```php
<!-- RIGHT - In loginPage.php -->
<form>...</form>
```

### ❌ Business logic in View
```php
<!-- WRONG - In loginPage.php -->
<?php
    if (!$username || strlen($username) < 3) {
        echo "Invalid";
    }
?>
```

### ✓ Validation in Controller
```php
// RIGHT - In loginController.php
$validation = validateUsername($username);
// Then pass to view
```

## Testing Each Layer

### Test Model
```php
// Test database function directly
$user = findUserByIdentifier($conn, "student1");
var_dump($user);
```

### Test Controller
```php
// Manually call controller function
$_POST['username'] = 'student1';
$_POST['password'] = 'password123';
$result = authenticateUser('student1', 'password123');
var_dump($result);
```

### Test View
```php
// Open in browser and check HTML
// F12 → Inspect to verify form structure
```

### Test Public
```php
// Visit the page in browser
// Check if controller executes
// Check if view displays
```

## Summary

- **Models** = Database layer (SQL queries)
- **Views** = Presentation layer (HTML/CSS)
- **Controllers** = Business logic layer (Validation, rules)
- **Public** = Entry points (User-facing pages)

This separation makes code:
- Easier to read
- Easier to maintain
- Easier to test
- Easier to expand

---

**Remember:** If you find yourself mixing concerns, stop and refactor!
