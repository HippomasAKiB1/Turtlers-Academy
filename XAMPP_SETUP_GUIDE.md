# XAMPP Setup Guide for Turtlers Academy

## Fixed Routing Issue

All paths have been updated to work with your XAMPP directory structure:
- Project location: `c:\xampp\htdocs\repo\Turtlers-Academy\`
- Access URL: `http://localhost/repo/Turtlers-Academy/`

## Path Updates Made

✅ **All absolute paths updated from `/Turtlers-Academy/` to `/repo/Turtlers-Academy/`**

### Files Updated:
1. **PHP Files:**
   - `app/partials/header.php` - All navigation links
   - `app/views/home/home.php` - CSS and JS assets
   - `app/views/student_dashboard/student_dashboard.php` - CSS, JS, and images
   - `app/views/tutor_dashboard/tutor_dashboard.php` - CSS, JS, and images
   - `app/views/quiz/result.php` - Navigation links
   - `app/views/upload_lesson/lesson_dashboard.php` - File links
   - `app/actions/logout.php` - Redirect target

2. **JavaScript Files:**
   - `public/assets/js/student_dashboard.js` - API endpoints
   - `public/assets/js/tutor_dashboard.js` - API endpoints
   - `public/assets/js/course_script.js` - API endpoints
   - `public/assets/js/quiz.js` - Form submission endpoints

## How to Run

### Step 1: Ensure XAMPP is Running
- Start XAMPP Control Panel
- Start Apache and MySQL services

### Step 2: Access the Application

Open your browser and go to:
```
http://localhost/repo/Turtlers-Academy/index.php
```

Or directly to the public entry point:
```
http://localhost/repo/Turtlers-Academy/public/index.php
```

### Step 3: Database Setup

Make sure your MySQL database `turtlers_academy` exists with the required tables:
- users
- courses
- enrollments
- quizzes
- quiz_results
- resources
- forum
- lessons

Database Configuration (in `core/database.php`):
- Host: `localhost`
- User: `root`
- Password: (empty)
- Database: `turtlers_academy`

## Navigation Flow

### Home Page
- **URL:** `/repo/Turtlers-Academy/public/index.php`
- Shows course listings
- "Log In" / "Sign Up" buttons for unauthenticated users
- Dashboard link for authenticated users

### Login
- **URL:** `/repo/Turtlers-Academy/public/login.php`
- Authenticates user credentials
- Redirects to dashboard on success

### Register
- **URL:** `/repo/Turtlers-Academy/public/register.php`
- Creates new user account
- Redirects to login on success

### Student Dashboard
- **URL:** `/repo/Turtlers-Academy/public/index.php` (after login)
- View bookmarked courses
- Enroll in new courses
- Access quizzes and resources

### Logout
- **URL:** `/repo/Turtlers-Academy/app/actions/logout.php`
- Clears session
- Redirects to home page

## Troubleshooting

### 404 Errors
If you see 404 errors, check:
1. ✅ Apache is running
2. ✅ URL includes `/repo/Turtlers-Academy/` path
3. ✅ PHP files exist in the expected locations

### Database Connection Errors
If the app shows "Database connection failed":
1. ✅ MySQL is running
2. ✅ Database `turtlers_academy` exists
3. ✅ Database credentials in `core/database.php` are correct

### Asset Files Not Loading (CSS/JS)
If styles or scripts aren't loading:
1. ✅ Check browser console for 404 errors
2. ✅ Verify paths use `/repo/Turtlers-Academy/public/assets/...`
3. ✅ Clear browser cache (Ctrl+Shift+Delete)

## API Endpoints

All API endpoints have been updated to use the correct absolute paths:

### Dashboard API
- `GET /repo/Turtlers-Academy/app/controllers/dashboardController.php?action=aboutme`
- `GET /repo/Turtlers-Academy/app/controllers/dashboardController.php?action=view_courses`
- `GET /repo/Turtlers-Academy/app/controllers/dashboardController.php?action=view_resources`

### Course API
- `GET /repo/Turtlers-Academy/app/controllers/courseController.php?action=courseDetails&id=ID`

### Tutor API
- `GET /repo/Turtlers-Academy/app/controllers/TutorController.php?action=getdata`
- `POST /repo/Turtlers-Academy/app/controllers/TutorController.php?action=process_upload`

### Quiz API
- `POST /repo/Turtlers-Academy/public/ajax/submit_quiz.php` - Submit quiz answers

## Success Indicators

When the application is working correctly, you should see:

✅ Home page loads with course cards
✅ Login button opens login form
✅ Register button opens registration form
✅ After login, dashboard appears with student name
✅ All navigation links work
✅ Logout clears session and returns to home

---

Last Updated: January 18, 2026
