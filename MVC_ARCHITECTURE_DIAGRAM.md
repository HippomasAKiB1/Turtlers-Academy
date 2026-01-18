# MVC Authentication System - Visual Architecture

## Complete System Overview

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         TURTLERS ACADEMY                                │
│                   MVC Authentication System (v2.0)                      │
└─────────────────────────────────────────────────────────────────────────┘

                              🌐 USER BROWSER

                    ┌──────────────────────────────┐
                    │   User Interface Layer       │
                    │   (HTML, CSS, JavaScript)    │
                    │                              │
                    │  • Forms                     │
                    │  • Input validation          │
                    │  • AJAX requests             │
                    └──────────────────────────────┘
                              ↕ HTTP
┌──────────────────────────────────────────────────────────────────────────┐
│                    🔵 PUBLIC LAYER (Entry Points)                        │
│                                                                          │
│  /public/login.php      ←→    /public/register.php                       │
│  ├─ Check if logged in         ├─ Check if logged in                    │
│  ├─ Load controller            ├─ Load controller                       │
│  └─ Load view                  └─ Load view                             │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Include
┌──────────────────────────────────────────────────────────────────────────┐
│              🟢 CONTROLLER LAYER (Business Logic)                        │
│                                                                          │
│  loginController.php            registerController.php                   │
│  ├─ POST Handler                ├─ POST Handler                         │
│  ├─ validateLoginForm()         ├─ validateRegistrationForm()           │
│  ├─ authenticateUser()          ├─ registerNewUser()                    │
│  ├─ createUserSession()         ├─ validateRegisterUsername()           │
│  ├─ destroyUserSession()        ├─ validateRegisterEmail()              │
│  ├─ isUserLoggedIn()            ├─ validateFullName()                   │
│  └─ getCurrentUser()            ├─ validatePasswordMatch()              │
│                                  └─ createStudentProfile()/             │
│                                    createInstructorProfile()             │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Call
┌──────────────────────────────────────────────────────────────────────────┐
│              🟡 MODEL LAYER (Database Operations)                        │
│                                                                          │
│  loginModel.php                 registerModel.php                        │
│  ├─ findUserByIdentifier()      ├─ createUser()                         │
│  ├─ findUserById()              ├─ getUserByUsername()                  │
│  ├─ verifyPassword()            ├─ getUserByEmail()                     │
│  ├─ usernameExists()            ├─ isUsernameAvailable()                │
│  ├─ emailExists()               ├─ isEmailAvailable()                   │
│  ├─ isLoginRateLimited()        ├─ createStudentProfile()               │
│  ├─ recordFailedLoginAttempt()  └─ createInstructorProfile()            │
│  ├─ clearLoginAttempts()                                                │
│  └─ logLoginAttempt()                                                   │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Query
┌──────────────────────────────────────────────────────────────────────────┐
│            💾 DATABASE LAYER (Data Persistence)                          │
│                                                                          │
│  MySQL Database: turtlers_academy                                       │
│  ├─ users                                                               │
│  │  ├─ id (PK)                                                          │
│  │  ├─ username (UNIQUE)                                                │
│  │  ├─ email (UNIQUE)                                                   │
│  │  ├─ full_name                                                        │
│  │  ├─ password                                                         │
│  │  ├─ role (student/instructor/admin)                                 │
│  │  ├─ profile_pic                                                      │
│  │  ├─ created_at                                                       │
│  │  └─ updated_at                                                       │
│  │                                                                      │
│  ├─ students                                                            │
│  │  ├─ id (PK)                                                          │
│  │  ├─ user_id (FK)                                                     │
│  │  ├─ institution                                                      │
│  │  ├─ cgpa                                                             │
│  │  └─ created_at                                                       │
│  │                                                                      │
│  └─ instructors                                                         │
│     ├─ id (PK)                                                          │
│     ├─ user_id (FK)                                                     │
│     ├─ bio                                                              │
│     ├─ institution                                                      │
│     ├─ profile_image                                                    │
│     └─ created_at                                                       │
└──────────────────────────────────────────────────────────────────────────┘

                              ↕ Return Data
┌──────────────────────────────────────────────────────────────────────────┐
│              🟡 MODEL LAYER (Data Transformation)                        │
│                                                                          │
│  loginModel.php / registerModel.php                                     │
│  ├─ Fetch from database                                                │
│  ├─ Format results                                                     │
│  └─ Return to controller                                               │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Process
┌──────────────────────────────────────────────────────────────────────────┐
│              🟢 CONTROLLER LAYER (Response Preparation)                  │
│                                                                          │
│  loginController.php / registerController.php                           │
│  ├─ Validate data                                                      │
│  ├─ Create sessions                                                    │
│  ├─ Return JSON response                                               │
│  └─ Set headers (HTTP status, Content-Type)                            │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ JSON Response
┌──────────────────────────────────────────────────────────────────────────┐
│              🟢 VIEW LAYER (Data Presentation)                           │
│                                                                          │
│  loginPage.php / registerPage.php                                       │
│  ├─ Display form (HTML)                                                │
│  ├─ Show errors                                                        │
│  ├─ Display success messages                                           │
│  └─ Render with styling (CSS)                                          │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Process
┌──────────────────────────────────────────────────────────────────────────┐
│            🔵 JAVASCRIPT LAYER (Client-side Logic)                       │
│                                                                          │
│  login.js / register.js                                                 │
│  ├─ Client-side validation                                             │
│  ├─ AJAX form submission                                               │
│  ├─ Error/success handling                                             │
│  ├─ Loading state management                                           │
│  └─ Page redirects                                                     │
└──────────────────────────────────────────────────────────────────────────┘
                              ↕ Display
                    ┌──────────────────────────────┐
                    │   🌐 User Browser Display    │
                    │                              │
                    │  • Updated page content      │
                    │  • User info in header       │
                    │  • Redirect to home/login    │
                    └──────────────────────────────┘
```

---

## Login Flow Diagram

```
User visits /login.php
    │
    ├─ Check if logged in?
    │   ├─ YES → Redirect to home
    │   └─ NO → Continue
    │
    ├─ Include loginController.php
    │   └─ Check for POST request
    │       └─ NO POST → Load view and display
    │
    └─ Include loginPage.php (View)
        └─ Display login form


User submits form
    │
    ├─ JavaScript (login.js)
    │   ├─ Validate client-side
    │   │   ├─ Empty fields?
    │   │   ├─ Username format?
    │   │   └─ Password length?
    │   │
    │   ├─ Validation fails?
    │   │   └─ Show field errors, stop
    │   │
    │   └─ Validation passes?
    │       └─ Continue to AJAX
    │
    ├─ AJAX POST to loginController.php
    │   │
    │   └─ loginController.php (Controller)
    │       ├─ Receive POST data
    │       │
    │       ├─ Call validateLoginForm()
    │       │   ├─ Check username length (3+)
    │       │   ├─ Check password length (6+)
    │       │   └─ Check for empty fields
    │       │
    │       ├─ Validation fails?
    │       │   └─ Return JSON errors
    │       │
    │       ├─ Validation passes?
    │       │   └─ Call authenticateUser()
    │       │       │
    │       │       └─ Call loginModel functions
    │       │           ├─ findUserByIdentifier()
    │       │           │   ├─ Query database for user
    │       │           │   └─ Return user or null
    │       │           │
    │       │           ├─ User not found?
    │       │           │   ├─ recordFailedLoginAttempt()
    │       │           │   └─ Return error
    │       │           │
    │       │           ├─ User found?
    │       │           │   └─ verifyPassword()
    │       │           │       ├─ Compare password
    │       │           │       └─ Return true/false
    │       │           │
    │       │           ├─ Password wrong?
    │       │           │   ├─ recordFailedLoginAttempt()
    │       │           │   └─ Return error
    │       │           │
    │       │           └─ Password correct?
    │       │               ├─ clearLoginAttempts()
    │       │               └─ Return user data
    │       │
    │       ├─ Authentication fails?
    │       │   └─ Return JSON error
    │       │
    │       └─ Authentication succeeds?
    │           ├─ createUserSession()
    │           │   └─ Set $_SESSION variables
    │           │       ├─ user_id
    │           │       ├─ username
    │           │       ├─ full_name
    │           │       ├─ email
    │           │       ├─ role
    │           │       ├─ login_time
    │           │       └─ logged_in = true
    │           │
    │           └─ Return JSON success
    │               ├─ success: true
    │               ├─ message: "Login successful!"
    │               └─ redirect: "/Turtlers-Academy/public/index.php"
    │
    ├─ JavaScript receives response
    │   │
    │   ├─ Response success?
    │   │   ├─ NO → Display error alert
    │   │   └─ YES → Continue
    │   │
    │   ├─ Show success alert
    │   │   └─ "Login successful! Redirecting..."
    │   │
    │   └─ Redirect to home
    │       └─ window.location.href = redirect URL
    │
    └─ User sees home page
        └─ Header shows user info (name, role, logout button)
```

---

## Registration Flow Diagram

```
User visits /register.php
    │
    ├─ Check if logged in?
    │   ├─ YES → Redirect to home
    │   └─ NO → Continue
    │
    ├─ Include registerController.php
    │   └─ Check for POST request
    │       └─ NO POST → Load view and display
    │
    └─ Include registerPage.php (View)
        └─ Display registration form


User selects account type
    │
    └─ JavaScript (register.js)
        └─ Show/hide conditional fields
            └─ If Instructor selected
                └─ Show bio field


User fills form
    │
    ├─ As user types (blur event)
    │   └─ Field validation in register.js
    │       ├─ Check field format
    │       ├─ Show/hide field error
    │       └─ Disable submit if invalid
    │
    └─ User submits form
        │
        ├─ JavaScript (register.js)
        │   ├─ validateForm()
        │   │   ├─ validateField(username)
        │   │   │   ├─ Check length (3-50)
        │   │   │   ├─ Check format (alphanumeric + _ .)
        │   │   │   └─ Check for errors
        │   │   │
        │   │   ├─ validateField(email)
        │   │   │   ├─ Check format (user@domain.ext)
        │   │   │   └─ Check for errors
        │   │   │
        │   │   ├─ validateField(full_name)
        │   │   │   ├─ Check length (3+)
        │   │   │   └─ Check for errors
        │   │   │
        │   │   ├─ validateField(password)
        │   │   │   ├─ Check length (6+)
        │   │   │   └─ Check for errors
        │   │   │
        │   │   ├─ validatePasswordMatch()
        │   │   │   ├─ password === password_confirm?
        │   │   │   └─ Check for errors
        │   │   │
        │   │   └─ validateRole()
        │   │       ├─ Is role selected?
        │   │       └─ Check for errors
        │   │
        │   ├─ Validation fails?
        │   │   └─ Show field errors, stop
        │   │
        │   └─ Validation passes?
        │       └─ Continue to AJAX
        │
        └─ AJAX POST to registerController.php
            │
            └─ registerController.php (Controller)
                ├─ Receive POST data
                │
                ├─ Call validateRegistrationForm()
                │   ├─ validateRegisterUsername()
                │   │   ├─ Check length (3-50)
                │   │   ├─ Check format
                │   │   └─ isUsernameAvailable()?
                │   │
                │   ├─ validateRegisterEmail()
                │   │   ├─ Check email format
                │   │   └─ isEmailAvailable()?
                │   │
                │   ├─ validateFullName()
                │   │   └─ Check length (3+)
                │   │
                │   ├─ validateRegisterPassword()
                │   │   └─ Check length (6+)
                │   │
                │   ├─ validatePasswordMatch()
                │   │   └─ Check if match
                │   │
                │   └─ validateAccountType()
                │       └─ Check if valid role
                │
                ├─ Validation fails?
                │   └─ Return JSON errors
                │
                └─ Validation passes?
                    └─ Call registerNewUser()
                        │
                        ├─ Call registerModel.createUser()
                        │   ├─ INSERT into users table
                        │   └─ Return user_id
                        │
                        ├─ User creation fails?
                        │   └─ Return error
                        │
                        ├─ User creation succeeds?
                        │   └─ Call profile creation
                        │       ├─ If role === 'student'
                        │       │   └─ createStudentProfile(user_id)
                        │       │       └─ INSERT into students table
                        │       │
                        │       └─ If role === 'instructor'
                        │           └─ createInstructorProfile(user_id)
                        │               └─ INSERT into instructors table
                        │
                        └─ Return JSON success
                            ├─ success: true
                            ├─ message: "Registration successful!"
                            └─ user_id: 123


JavaScript receives response
    │
    ├─ Response success?
    │   ├─ NO → Display error alert with field errors
    │   └─ YES → Continue
    │
    ├─ Show success alert
    │   └─ "Account created successfully! Redirecting..."
    │
    ├─ Wait 2 seconds
    │   └─ Time to read message
    │
    └─ Redirect to login
        └─ window.location.href = "/Turtlers-Academy/public/login.php"


User can now login with new account
    │
    └─ User can access courses, quizzes, etc.
```

---

## Session Management Flow

```
After Successful Login
    │
    ├─ createUserSession($user)
    │   └─ $_SESSION['user_id'] = 123
    │   └─ $_SESSION['username'] = 'student1'
    │   └─ $_SESSION['full_name'] = 'John Student'
    │   └─ $_SESSION['email'] = 'student1@example.com'
    │   └─ $_SESSION['role'] = 'student'
    │   └─ $_SESSION['login_time'] = time()
    │   └─ $_SESSION['logged_in'] = true
    │
    └─ Session cookie set
        └─ PHPSESSID=abc123...
            └─ Stored in browser
            └─ Sent with every request


On Next Page Load
    │
    ├─ Browser sends PHPSESSID cookie
    │   │
    │   └─ session_start() 
    │       └─ Retrieves session from server
    │
    ├─ header.php checks
    │   ├─ isset($_SESSION['logged_in'])?
    │   ├─ $_SESSION['logged_in'] === true?
    │   │
    │   ├─ YES → Show user info
    │   │   ├─ Avatar with first letter
    │   │   ├─ Full name
    │   │   ├─ Role
    │   │   └─ Logout button
    │   │
    │   └─ NO → Show login/signup buttons
    │
    ├─ header.php sets JavaScript variable
    │   └─ USER_LOGGED_IN = true/false
    │
    └─ JavaScript can check
        └─ if (USER_LOGGED_IN) { ... }


On Logout
    │
    ├─ User clicks logout button
    │   │
    │   └─ Goes to logout.php
    │
    ├─ logout.php
    │   ├─ session_destroy()
    │   │   └─ Destroys session file on server
    │   │
    │   └─ $_SESSION = []
    │       └─ Clears session array
    │
    └─ Redirect to home
        └─ Session cleared, user logged out
            └─ Next page shows login button
```

---

## Database Schema Relationships

```
┌─────────────────────────────────────────────────────────────────┐
│                    DATABASE RELATIONSHIPS                       │
└─────────────────────────────────────────────────────────────────┘

    ┌──────────────────────┐
    │       users          │
    │                      │
    │ ├─ id (PK)           │
    │ ├─ username (UNIQUE) │
    │ ├─ email (UNIQUE)    │
    │ ├─ full_name         │
    │ ├─ password          │
    │ ├─ role              │
    │ ├─ profile_pic       │
    │ ├─ created_at        │
    │ └─ updated_at        │
    └──────────┬───────────┘
               │ (one-to-one)
        ┌──────┴──────┐
        │             │
        ▼             ▼
┌───────────────┐ ┌──────────────────┐
│   students    │ │   instructors    │
│               │ │                  │
│ ├─ id (PK)    │ │ ├─ id (PK)       │
│ ├─ user_id(FK)├─┘ ├─ user_id (FK)  │
│ ├─ institution│   ├─ name          │
│ ├─ cgpa       │   ├─ email         │
│ └─ created_at │   ├─ bio           │
│               │   ├─ institution   │
│               │   ├─ profile_image │
│               │   └─ created_at    │
└───────────────┘ └──────────────────┘


Registration Process:
    users table INSERT
        ↓
    users.id = 123
        ↓
        ├─ If role='student' → students INSERT with user_id=123
        └─ If role='instructor' → instructors INSERT with user_id=123


Login Process:
    Find user in users table
        ↓
    SELECT * FROM users WHERE username='student1'
        ↓
    Get users.id, users.role, users.password
        ↓
    Compare password
        ↓
    If match, create session with user data
```

---

## File Communication Map

```
                    Browser
                       │
                       │ HTTP Request
                       ▼
            ┌─────────────────────┐
            │  public/login.php   │
            └─────────┬───────────┘
                      │ Include
        ┌─────────────┴──────────────┐
        │                            │
        ▼                            ▼
  ┌─────────────────┐      ┌──────────────────┐
  │ loginController │      │ loginPage (View) │
  └─────────┬───────┘      └──────────┬───────┘
            │ Call                    │ Includes
            │                         │
            ├─ loginModel            ├─ HTML form
            │ Functions              ├─ login.css
            │                        ├─ login.js
            │                        │
            ▼                        │ AJAX
        Query                    ┌────┴─────┐
      Database                  │           │
      (MySQL)                   ▼           ▼
                          Validate    Submit
                          Fields     Data


Register Flow:
                    Browser
                       │
                       │ HTTP Request
                       ▼
         ┌──────────────────────────┐
         │ public/register.php      │
         └──────────┬───────────────┘
                    │ Include
      ┌─────────────┴───────────────┐
      │                             │
      ▼                             ▼
┌──────────────────┐      ┌─────────────────────┐
│registerController│      │registerPage (View)  │
└─────────┬────────┘      └──────────┬──────────┘
          │ Call                     │ Includes
          │                          │
  ├─registerModel          ├─ HTML form
  │ Functions              ├─ radio buttons
  │                        ├─ conditional fields
  │                        ├─ register.css
  │                        ├─ register.js
  │                        │
  │                        │ AJAX
  │                    ┌───┴──────┐
  │                    │          │
  ▼                    ▼          ▼
Query              Validate   Submit
Database           Fields     Data
(MySQL)
  │
  ├─ users table
  ├─ students table
  └─ instructors table
```

---

## Asset Loading Diagram

```
Page Request
    │
    ├─ Load HTML (loginPage.php)
    │   │
    │   ├─ <link> tag for login.css
    │   ├─ <script> tag for login.js
    │   └─ Form elements (input, button, etc.)
    │
    ├─ Browser downloads login.css
    │   └─ Apply styles to page
    │
    ├─ Browser downloads login.js
    │   └─ Attach event listeners
    │       ├─ form submit
    │       ├─ field blur
    │       ├─ field input
    │       └─ Enter key press
    │
    └─ Page ready for user interaction
        ├─ User can type
        ├─ Fields validate on blur
        ├─ Form submits via AJAX
        └─ Errors display in real-time
```

---

## Summary

This MVC architecture ensures:
- **Models** handle all database interactions
- **Controllers** implement all business logic
- **Views** display user interfaces
- **Public** serves as entry points
- **JavaScript** adds client-side functionality
- **CSS** provides professional styling
- **Data flows** clearly through layers
- **Security** at multiple levels

✅ Clean separation of concerns  
✅ Easy to test each layer  
✅ Simple to maintain and update  
✅ Scalable for future features  

