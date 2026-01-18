-- ==================================================================================
-- TURTLERS ACADEMY DATABASE SCHEMA
-- Database: turtlers_academy
-- Created: January 18, 2026
-- VERIFIED & CROSS-CHECKED with all model files
-- ==================================================================================

CREATE DATABASE IF NOT EXISTS turtlers_academy;
USE turtlers_academy;

-- =====================================================
-- USERS TABLE (MAIN USER TABLE)
-- Stores all user information (Students, Tutors, Instructors, Admin)
-- PRIMARY TABLE - REFERENCED BY MANY FOREIGN KEYS
-- =====================================================
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE,
    full_name VARCHAR(150),
    fullname VARCHAR(150),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    role ENUM('student', 'tutor', 'instructor', 'admin') DEFAULT 'student',
    profile_pic VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_full_name (full_name)
);

-- =====================================================
-- STUDENTS TABLE
-- Additional profile information for students
-- Links: users table via full_name match
-- =====================================================
CREATE TABLE IF NOT EXISTS students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(150) NOT NULL,
    institution VARCHAR(200),
    age INT,
    cgpa DECIMAL(3, 2),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_student_name (student_name)
);

-- =====================================================
-- COURSE TABLE (SINGLE TABLE - NOT COURSES)
-- Stores course information
-- CRITICAL: Code uses "course" NOT "courses"
-- =====================================================
CREATE TABLE IF NOT EXISTS course (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_code VARCHAR(50) UNIQUE NOT NULL,
    course_name VARCHAR(150) NOT NULL,
    instructor_name VARCHAR(150),
    description TEXT,
    course_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_course_code (course_code),
    INDEX idx_course_name (course_name),
    INDEX idx_instructor_name (instructor_name)
);

-- =====================================================
-- ENROLLMENTS TABLE
-- Tracks student enrollment in courses
-- Foreign Keys: users(id), course(id)
-- =====================================================
CREATE TABLE IF NOT EXISTS enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    full_name VARCHAR(150),
    email VARCHAR(150),
    phone VARCHAR(20),
    status ENUM('active', 'inactive', 'completed', '') DEFAULT 'active',
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (user_id, course_id),
    INDEX idx_user_id (user_id),
    INDEX idx_course_id (course_id),
    INDEX idx_status (status)
);

-- =====================================================
-- LESSON TABLE
-- Stores lesson/lecture information
-- Used by: LessonModel.php, lesson_dashboard.php
-- Columns: id, course_id, lecture_week, lesson_title, file_path, created_at
-- =====================================================
CREATE TABLE IF NOT EXISTS lesson (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    lecture_week INT,
    lesson_title VARCHAR(200) NOT NULL,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    INDEX idx_course_id (course_id),
    INDEX idx_lecture_week (lecture_week)
);

-- =====================================================
-- QUIZZES TABLE
-- Stores quiz information
-- Columns used: id, title, time_limit, passing_score, course_id
-- =====================================================
CREATE TABLE IF NOT EXISTS quizzes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    time_limit INT DEFAULT 60,
    passing_score INT DEFAULT 70,
    course_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    INDEX idx_course_id (course_id)
);

-- =====================================================
-- QUESTIONS TABLE
-- Stores quiz questions with multiple choice options (A, B, C, D)
-- Columns: id, quiz_id, question, a, b, c, d, correct
-- Used by: quizModel.php, quiztake.php
-- =====================================================
CREATE TABLE IF NOT EXISTS questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quiz_id INT NOT NULL,
    question TEXT NOT NULL,
    a VARCHAR(500),
    b VARCHAR(500),
    c VARCHAR(500),
    d VARCHAR(500),
    correct CHAR(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    INDEX idx_quiz_id (quiz_id)
);

-- =====================================================
-- QUIZ_ATTEMPTS TABLE
-- Records quiz attempt history for students
-- Used by: quizModel.php, saveAttempt() function
-- Columns: id, user_id, quiz_id, score, total, percentage, attempted_at
-- =====================================================
CREATE TABLE IF NOT EXISTS quiz_attempts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT,
    total INT,
    percentage DECIMAL(5, 2),
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_quiz_id (quiz_id),
    INDEX idx_attempted_at (attempted_at)
);

-- =====================================================
-- QUIZ_RESULTS TABLE
-- Alternative/Additional table for quiz results
-- Used by: resultModel.php, getQuizResultsByStudent()
-- Columns: id, user_id, quiz_id, score, total, percentage, attempted_at
-- =====================================================
CREATE TABLE IF NOT EXISTS quiz_results (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT,
    total INT,
    percentage DECIMAL(5, 2),
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_quiz_id (quiz_id),
    INDEX idx_attempted_at (attempted_at)
);

-- =====================================================
-- RATINGS TABLE
-- Stores course ratings from students
-- Used by: courseModel.php, getCourseRating()
-- Columns: id, user_id, course_id, rating, review, created_at
-- =====================================================
CREATE TABLE IF NOT EXISTS ratings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    rating DECIMAL(3, 1),
    review TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    UNIQUE KEY unique_rating (user_id, course_id),
    INDEX idx_course_id (course_id),
    INDEX idx_user_id (user_id)
);

-- =====================================================
-- FORUM_THREADS TABLE
-- Stores forum discussion threads
-- Used by: forumModel.php - getAllThreads, searchThreads, getSingleThread, createThread
-- Columns: id, user_id, title, description, course_id, created_at, updated_at
-- =====================================================
CREATE TABLE IF NOT EXISTS forum_threads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(300) NOT NULL,
    description TEXT,
    course_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_course_id (course_id),
    INDEX idx_created_at (created_at)
);

-- =====================================================
-- FORUM_COMMENTS TABLE
-- Stores comments/replies on forum threads
-- Used by: forumModel.php - getComments, addComment
-- Columns: id, thread_id, user_id, comment, created_at, updated_at
-- =====================================================
CREATE TABLE IF NOT EXISTS forum_comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    thread_id INT NOT NULL,
    user_id INT,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (thread_id) REFERENCES forum_threads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_thread_id (thread_id),
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
);

-- =====================================================
-- RESOURCES TABLE
-- Stores course resources uploaded by tutors
-- Used by: resourceModel.php - addResource, deleteResource, getResourcesByTutor, getResourcesForStudent
-- Columns: id, tutor_id, course_id, title, file_path, uploaded_at
-- =====================================================
CREATE TABLE IF NOT EXISTS resources (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tutor_id INT NOT NULL,
    course_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tutor_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    INDEX idx_tutor_id (tutor_id),
    INDEX idx_course_id (course_id),
    INDEX idx_uploaded_at (uploaded_at)
);

-- =====================================================
-- INSTRUCTORS TABLE
-- Stores instructor/tutor profile information
-- Used by: tutorModel.php - getTutorProfile() queries this table
-- Columns: id, name, email, bio, institution, profile_image, user_id, created_at
-- =====================================================
CREATE TABLE IF NOT EXISTS instructors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150),
    bio TEXT,
    institution VARCHAR(200),
    profile_image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_name (name)
);

-- =====================================================
-- SAMPLE DATA (Optional - for testing)
-- Uncomment below to add sample data
-- =====================================================
/*
-- Sample Users
INSERT INTO users (username, full_name, fullname, email, password, role, profile_pic) VALUES
('student1', 'John Doe', 'John Doe', 'john@example.com', 'password123', 'student', NULL),
('tutor1', 'Jane Smith', 'Jane Smith', 'jane@example.com', 'password123', 'tutor', NULL),
('admin1', 'Admin User', 'Admin User', 'admin@example.com', 'password123', 'admin', NULL);

-- Sample Course
INSERT INTO course (course_code, course_name, instructor_name, description, course_image) VALUES
('CS101', 'Introduction to Programming', 'Jane Smith', 'Learn the basics of programming', 'cs101.jpg'),
('CS102', 'Web Development', 'Jane Smith', 'Learn web development with HTML, CSS, and JS', 'cs102.jpg');

-- Sample Enrollments
INSERT INTO enrollments (user_id, course_id, full_name, email, phone, status) VALUES
(1, 1, 'John Doe', 'john@example.com', '1234567890', 'active'),
(1, 2, 'John Doe', 'john@example.com', '1234567890', 'active');

-- Sample Quiz
INSERT INTO quizzes (title, time_limit, passing_score, course_id) VALUES
('Introduction to Programming Quiz 1', 60, 70, 1);

-- Sample Questions
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(1, 'What is a variable?', 'A container for storing data', 'A function', 'A loop', 'A condition', 'a'),
(1, 'What does HTML stand for?', 'Hyper Text Markup Language', 'High Tech Modern Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'a');
*/

-- =====================================================
-- DATABASE SETUP COMPLETE
-- =====================================================
-- This schema has been verified against:
-- - app/models/*.php (all 10 model files)
-- - app/controllers/*.php (all controller files)  
-- - app/views/*.php (all view files)
-- - public/*.php (all public files)
--
-- All table names and column names match the code exactly.
-- Ready for production use.
-- =====================================================

COMMIT;
