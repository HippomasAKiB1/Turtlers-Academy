-- ==================================================================================
-- TURTLERS ACADEMY - SAMPLE DATA INSERT QUERIES
-- Comprehensive test data for all tables
-- ==================================================================================

USE turtlers_academy;

-- =====================================================
-- 1. INSERT USERS DATA
-- Creating students, tutors, and admin users
-- =====================================================
INSERT INTO users (username, full_name, fullname, email, password, role, profile_pic) VALUES
-- Students
('student1', 'John Doe', 'John Doe', 'john@example.com', 'password123', 'student', NULL),
('student2', 'Sarah Johnson', 'Sarah Johnson', 'sarah@example.com', 'password123', 'student', NULL),
('student3', 'Michael Brown', 'Michael Brown', 'michael@example.com', 'password123', 'student', NULL),
('student4', 'Emma Wilson', 'Emma Wilson', 'emma@example.com', 'password123', 'student', NULL),
('student5', 'David Lee', 'David Lee', 'david@example.com', 'password123', 'student', NULL),

-- Tutors/Instructors
('tutor1', 'Jane Smith', 'Jane Smith', 'jane@example.com', 'password123', 'tutor', NULL),
('tutor2', 'Robert Taylor', 'Robert Taylor', 'robert@example.com', 'password123', 'instructor', NULL),
('tutor3', 'Lisa Anderson', 'Lisa Anderson', 'lisa@example.com', 'password123', 'tutor', NULL),

-- Admin
('admin1', 'Admin User', 'Admin User', 'admin@example.com', 'password123', 'admin', NULL);

-- =====================================================
-- 2. INSERT STUDENTS TABLE DATA
-- Additional student profile information
-- =====================================================
INSERT INTO students (student_name, institution, age, cgpa, user_id) VALUES
('John Doe', 'Harvard University', 20, 3.75, 1),
('Sarah Johnson', 'MIT', 21, 3.85, 2),
('Michael Brown', 'Stanford University', 19, 3.65, 3),
('Emma Wilson', 'Yale University', 20, 3.90, 4),
('David Lee', 'Carnegie Mellon University', 22, 3.55, 5);

-- =====================================================
-- 3. INSERT COURSES DATA
-- Create multiple courses with different instructors
-- =====================================================
INSERT INTO course (course_code, course_name, instructor_name, description, course_image) VALUES
('CS101', 'Introduction to Programming', 'Jane Smith', 'Learn the basics of programming with Python. This course covers variables, loops, conditionals, and functions.', 'cs101.jpg'),
('CS102', 'Web Development with HTML & CSS', 'Jane Smith', 'Master the fundamentals of web development. Learn HTML5 and modern CSS3 techniques.', 'cs102.jpg'),
('CS103', 'JavaScript Essentials', 'Robert Taylor', 'Complete guide to JavaScript for beginners. Learn DOM manipulation, events, and async programming.', 'cs103.jpg'),
('CS104', 'Database Design & SQL', 'Lisa Anderson', 'Learn relational databases and SQL. Design efficient schemas and write complex queries.', 'cs104.jpg'),
('CS105', 'React.js Fundamentals', 'Robert Taylor', 'Build modern web applications with React. Learn components, hooks, and state management.', 'cs105.jpg'),
('CS106', 'Data Science Basics', 'Lisa Anderson', 'Introduction to data science using Python. Learn pandas, matplotlib, and basic machine learning.', 'cs106.jpg'),
('CS107', 'Mobile App Development', 'Jane Smith', 'Develop mobile applications for iOS and Android. Learn React Native and native development.', 'cs107.jpg');

-- =====================================================
-- 4. INSERT ENROLLMENTS DATA
-- Students enrolling in multiple courses
-- =====================================================
INSERT INTO enrollments (user_id, course_id, full_name, email, phone, status) VALUES
-- John Doe enrolled in 3 courses
(1, 1, 'John Doe', 'john@example.com', '1234567890', 'active'),
(1, 2, 'John Doe', 'john@example.com', '1234567890', 'active'),
(1, 3, 'John Doe', 'john@example.com', '1234567890', 'active'),

-- Sarah Johnson enrolled in 2 courses
(2, 1, 'Sarah Johnson', 'sarah@example.com', '1234567891', 'active'),
(2, 4, 'Sarah Johnson', 'sarah@example.com', '1234567891', 'completed'),

-- Michael Brown enrolled in 3 courses
(3, 2, 'Michael Brown', 'michael@example.com', '1234567892', 'active'),
(3, 5, 'Michael Brown', 'michael@example.com', '1234567892', 'active'),
(3, 3, 'Michael Brown', 'michael@example.com', '1234567892', 'inactive'),

-- Emma Wilson enrolled in 2 courses
(4, 1, 'Emma Wilson', 'emma@example.com', '1234567893', 'active'),
(4, 6, 'Emma Wilson', 'emma@example.com', '1234567893', 'active'),

-- David Lee enrolled in 4 courses
(5, 2, 'David Lee', 'david@example.com', '1234567894', 'active'),
(5, 3, 'David Lee', 'david@example.com', '1234567894', 'active'),
(5, 4, 'David Lee', 'david@example.com', '1234567894', 'active'),
(5, 7, 'David Lee', 'david@example.com', '1234567894', 'active');

-- =====================================================
-- 5. INSERT LESSONS DATA
-- Multiple lessons per course
-- =====================================================
INSERT INTO lesson (course_id, lecture_week, lesson_title, file_path) VALUES
-- CS101 Lessons
(1, 1, 'Variables and Data Types', 'lesson_cs101_week1.pdf'),
(1, 2, 'Control Flow - If Statements', 'lesson_cs101_week2.pdf'),
(1, 3, 'Loops - For and While', 'lesson_cs101_week3.pdf'),
(1, 4, 'Functions and Modules', 'lesson_cs101_week4.pdf'),
(1, 5, 'Object-Oriented Programming', 'lesson_cs101_week5.pdf'),

-- CS102 Lessons
(2, 1, 'Introduction to HTML5', 'lesson_cs102_week1.pdf'),
(2, 2, 'CSS Basics and Selectors', 'lesson_cs102_week2.pdf'),
(2, 3, 'Box Model and Layout', 'lesson_cs102_week3.pdf'),
(2, 4, 'Responsive Design', 'lesson_cs102_week4.pdf'),

-- CS103 Lessons
(3, 1, 'JavaScript Basics', 'lesson_cs103_week1.pdf'),
(3, 2, 'DOM Manipulation', 'lesson_cs103_week2.pdf'),
(3, 3, 'Events and Event Listeners', 'lesson_cs103_week3.pdf'),
(3, 4, 'Asynchronous JavaScript', 'lesson_cs103_week4.pdf'),

-- CS104 Lessons
(4, 1, 'Database Fundamentals', 'lesson_cs104_week1.pdf'),
(4, 2, 'SQL SELECT Queries', 'lesson_cs104_week2.pdf'),
(4, 3, 'INSERT, UPDATE, DELETE Operations', 'lesson_cs104_week3.pdf'),
(4, 4, 'JOINs and Complex Queries', 'lesson_cs104_week4.pdf'),

-- CS105 Lessons
(5, 1, 'React Components', 'lesson_cs105_week1.pdf'),
(5, 2, 'JSX and Props', 'lesson_cs105_week2.pdf'),
(5, 3, 'State and Hooks', 'lesson_cs105_week3.pdf'),

-- CS106 Lessons
(6, 1, 'Python for Data Science', 'lesson_cs106_week1.pdf'),
(6, 2, 'Pandas DataFrames', 'lesson_cs106_week2.pdf'),
(6, 3, 'Data Visualization with Matplotlib', 'lesson_cs106_week3.pdf'),

-- CS107 Lessons
(7, 1, 'Mobile Development Basics', 'lesson_cs107_week1.pdf'),
(7, 2, 'React Native Setup', 'lesson_cs107_week2.pdf');

-- =====================================================
-- 6. INSERT QUIZZES DATA
-- Create quizzes for different courses
-- =====================================================
INSERT INTO quizzes (title, time_limit, passing_score, course_id) VALUES
('CS101 - Week 1 Quiz: Variables', 30, 70, 1),
('CS101 - Week 3 Quiz: Loops', 30, 70, 1),
('CS101 - Week 5 Quiz: OOP Concepts', 45, 75, 1),
('CS102 - HTML & CSS Quiz', 40, 70, 2),
('CS103 - JavaScript Basics Quiz', 45, 75, 3),
('CS103 - DOM Manipulation Quiz', 35, 70, 3),
('CS104 - SQL Fundamentals Quiz', 50, 80, 4),
('CS105 - React Components Quiz', 40, 75, 5),
('CS106 - Data Science Quiz', 60, 75, 6);

-- =====================================================
-- 7. INSERT QUESTIONS DATA
-- Multiple choice questions for each quiz
-- =====================================================
-- Quiz 1: CS101 - Week 1 Quiz: Variables
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(1, 'What is a variable in programming?', 'A container for storing data values', 'A function that performs operations', 'A loop that repeats code', 'A comment in code', 'a'),
(1, 'Which of the following is a valid variable name in Python?', 'my_var', '123var', 'my-var', 'my var', 'a'),
(1, 'What is the data type of 3.14 in Python?', 'integer', 'string', 'float', 'boolean', 'c'),
(1, 'How do you create a variable in Python?', 'var x = 5', 'x = 5', 'create x = 5', 'declare x = 5', 'b'),
(1, 'Which is the correct way to comment in Python?', '// This is a comment', '/* This is a comment */', '# This is a comment', '-- This is a comment', 'c');

-- Quiz 2: CS101 - Week 3 Quiz: Loops
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(2, 'What is a loop?', 'A structure that repeats code', 'A conditional statement', 'A function', 'A variable', 'a'),
(2, 'Which loop is best for iterating a known number of times?', 'while loop', 'for loop', 'do-while loop', 'All are equal', 'b'),
(2, 'What will be the output of: for i in range(3): print(i)', '0 1 2', '1 2 3', '0 1 2 3', '3', 'a'),
(2, 'How do you exit a loop in Python?', 'exit()', 'break', 'return', 'stop()', 'b'),
(2, 'What does continue do in a loop?', 'Stops the loop', 'Skips to the next iteration', 'Restarts the loop', 'Pauses the loop', 'b');

-- Quiz 3: CS101 - Week 5 Quiz: OOP Concepts
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(3, 'What is a class in OOP?', 'A function', 'A blueprint for creating objects', 'A variable', 'A data type', 'b'),
(3, 'What is an object?', 'An instance of a class', 'A function call', 'A data type', 'A variable name', 'a'),
(3, 'What is inheritance in OOP?', 'Creating multiple objects', 'A child class inheriting from parent class', 'Copying code', 'Making variables global', 'b'),
(3, 'What is the purpose of the __init__ method?', 'To define methods', 'To initialize an object', 'To delete objects', 'To import modules', 'b'),
(3, 'What is encapsulation?', 'Creating many classes', 'Hiding internal details and exposing only necessary parts', 'Inheriting from classes', 'Creating loops', 'b');

-- Quiz 4: CS102 - HTML & CSS Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(4, 'What does HTML stand for?', 'Hyperlinks and Text Markup Language', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'High Tech Modern Language', 'b'),
(4, 'Which tag is used for the main heading?', '<h1>', '<heading>', '<head>', '<title>', 'a'),
(4, 'What does CSS stand for?', 'Cascading Style Sheets', 'Computer Style Sheets', 'Creative Style Sheets', 'Colorful Style Sheets', 'a'),
(4, 'How do you add a background color to an element?', 'background: red;', 'bgcolor: red;', 'color: red;', 'bg-color: red;', 'a'),
(4, 'What is the correct CSS syntax for making text bold?', 'font-weight: bold;', 'text-weight: bold;', 'font: bold;', 'bold: true;', 'a');

-- Quiz 5: CS103 - JavaScript Basics Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(5, 'What is JavaScript used for?', 'Creating styles', 'Making web pages interactive', 'Creating databases', 'Server-side processing only', 'b'),
(5, 'How do you declare a variable in JavaScript?', 'var x = 5;', 'variable x = 5;', 'declare x = 5;', 'v x = 5;', 'a'),
(5, 'Which data type is not a primitive type?', 'string', 'number', 'object', 'boolean', 'c'),
(5, 'What is the result of 2 + "2" in JavaScript?', '4', '22', 'error', 'undefined', 'b'),
(5, 'How do you add a comment in JavaScript?', '# comment', '// comment', '<!-- comment -->', '/* comment */', 'b');

-- Quiz 6: CS103 - DOM Manipulation Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(6, 'What is the DOM?', 'Document Object Model', 'Data Object Management', 'Document Order Model', 'Dynamic Object Management', 'a'),
(6, 'How do you select an element by ID in JavaScript?', 'getElementById()', 'selectId()', 'querySelector()', 'getElement()', 'a'),
(6, 'How do you change the text content of an element?', 'innerHTML', 'textContent', 'Both innerHTML and textContent', 'contentText', 'c'),
(6, 'What does addEventListener do?', 'Adds styles to elements', 'Attaches an event handler to an element', 'Creates new elements', 'Removes elements', 'b'),
(6, 'How do you remove a class from an element?', 'classList.remove()', 'removeClass()', 'removeClass()', 'class.remove()', 'a');

-- Quiz 7: CS104 - SQL Fundamentals Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(7, 'What does SQL stand for?', 'Structured Query Language', 'Server Query Language', 'Standard Query Language', 'Simple Query Logic', 'a'),
(7, 'Which keyword is used to retrieve data?', 'INSERT', 'SELECT', 'UPDATE', 'DELETE', 'b'),
(7, 'How do you filter records in SQL?', 'FILTER', 'WHERE', 'FIND', 'SEARCH', 'b'),
(7, 'What is a PRIMARY KEY?', 'The first column', 'A unique identifier for each record', 'A key that opens the database', 'A password for the database', 'b'),
(7, 'Which operator is used to join conditions?', 'AND', 'OR', 'Both AND and OR', 'IF', 'c');

-- Quiz 8: CS105 - React Components Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(8, 'What is a React component?', 'A function or class that returns JSX', 'A CSS file', 'A database table', 'A server endpoint', 'a'),
(8, 'What is JSX?', 'JavaScript XML', 'Java Syntax Extension', 'JavaScript XPath', 'JSON Extended', 'a'),
(8, 'What is the difference between state and props?', 'No difference', 'Props are passed down, state is internal', 'State is passed down, props are internal', 'Both are the same', 'b'),
(8, 'How do you pass data to a component?', 'Using state', 'Using props', 'Using variables', 'Using functions', 'b'),
(8, 'What is a functional component?', 'A component written as a function', 'A component that performs functions', 'A component without state', 'All of the above', 'd');

-- Quiz 9: CS106 - Data Science Quiz
INSERT INTO questions (quiz_id, question, a, b, c, d, correct) VALUES
(9, 'What is a dataset?', 'A set of data collected for analysis', 'A database table', 'A spreadsheet file', 'A programming library', 'a'),
(9, 'What does pandas library do?', 'Manages data like a panda', 'Provides data structures for data analysis', 'Creates visualizations', 'Builds machine learning models', 'b'),
(9, 'What is a DataFrame in pandas?', 'A frame for data', 'A 2D table of data', 'A data visualization', 'A machine learning model', 'b'),
(9, 'Which library is used for data visualization?', 'pandas', 'numpy', 'matplotlib', 'scikit-learn', 'c'),
(9, 'What is the purpose of data preprocessing?', 'Cleaning and preparing data', 'Visualizing data', 'Training models', 'Deploying models', 'a');

-- =====================================================
-- 8. INSERT QUIZ_ATTEMPTS DATA
-- Students taking quizzes with different scores
-- =====================================================
INSERT INTO quiz_attempts (user_id, quiz_id, score, total, percentage) VALUES
-- John Doe's attempts
(1, 1, 4, 5, 80.00),
(1, 2, 5, 5, 100.00),
(1, 3, 3, 5, 60.00),
(1, 4, 4, 5, 80.00),
(1, 5, 4, 5, 80.00),

-- Sarah Johnson's attempts
(2, 1, 5, 5, 100.00),
(2, 3, 4, 5, 80.00),
(2, 7, 4, 5, 80.00),

-- Michael Brown's attempts
(3, 2, 3, 5, 60.00),
(3, 4, 5, 5, 100.00),
(3, 5, 4, 5, 80.00),
(3, 8, 3, 5, 60.00),

-- Emma Wilson's attempts
(4, 1, 5, 5, 100.00),
(4, 2, 5, 5, 100.00),
(4, 9, 4, 5, 80.00),

-- David Lee's attempts
(5, 2, 4, 5, 80.00),
(5, 4, 3, 5, 60.00),
(5, 5, 5, 5, 100.00),
(5, 6, 4, 5, 80.00),
(5, 7, 5, 5, 100.00);

-- =====================================================
-- 9. INSERT QUIZ_RESULTS DATA
-- Alternative results table
-- =====================================================
INSERT INTO quiz_results (user_id, quiz_id, score, total, percentage) VALUES
-- John Doe's results
(1, 1, 4, 5, 80.00),
(1, 2, 5, 5, 100.00),
(1, 3, 3, 5, 60.00),

-- Sarah Johnson's results
(2, 1, 5, 5, 100.00),
(2, 7, 4, 5, 80.00),

-- Michael Brown's results
(3, 2, 3, 5, 60.00),
(3, 4, 5, 5, 100.00),

-- Emma Wilson's results
(4, 1, 5, 5, 100.00),
(4, 9, 4, 5, 80.00),

-- David Lee's results
(5, 5, 5, 5, 100.00),
(5, 7, 5, 5, 100.00);

-- =====================================================
-- 10. INSERT RATINGS DATA
-- Students rating courses they've taken
-- =====================================================
INSERT INTO ratings (user_id, course_id, rating, review) VALUES
(1, 1, 4.5, 'Great course! Very well explained with good examples.'),
(1, 2, 4.0, 'Good content, but could use more interactive exercises.'),
(1, 3, 4.8, 'Excellent JavaScript course. Highly recommended!'),
(2, 1, 5.0, 'Amazing instructor! Clear and concise explanations.'),
(2, 4, 4.2, 'Good SQL fundamentals course. Very practical.'),
(3, 2, 3.8, 'Decent course, but some topics could be clearer.'),
(3, 5, 4.6, 'React course is comprehensive and engaging.'),
(4, 1, 4.9, 'One of the best programming courses I\'ve taken!'),
(4, 6, 4.3, 'Good introduction to data science.'),
(5, 2, 4.4, 'Great course structure and content quality.'),
(5, 3, 4.7, 'JavaScript course exceeded my expectations!'),
(5, 4, 4.5, 'Solid SQL fundamentals with practical examples.'),
(5, 7, 4.1, 'Good introduction to mobile development.');

-- =====================================================
-- 11. INSERT FORUM_THREADS DATA
-- Discussion threads created by students
-- =====================================================
INSERT INTO forum_threads (user_id, title, description, course_id) VALUES
(1, 'How to debug Python code effectively?', 'I am struggling with debugging my Python programs. Can anyone share tips and tricks for effective debugging?', 1),
(2, 'Best practices for responsive design', 'What are the best practices for creating responsive web designs? I want to ensure my websites work on all devices.', 2),
(3, 'Understanding JavaScript closures', 'Can someone explain JavaScript closures with simple examples? I find this concept confusing.', 3),
(4, 'Optimizing SQL queries for performance', 'My SQL queries are running slowly. What are some techniques to optimize them?', 4),
(1, 'React Hooks vs Class Components', 'What are the advantages of using React hooks over class components? When should I use each?', 5),
(2, 'Getting started with machine learning', 'I want to start learning machine learning. Where should I begin and what resources do you recommend?', 6),
(5, 'Mobile development framework comparison', 'What\'s the best framework for mobile development - React Native or Flutter?', 7),
(3, 'CSS Grid vs Flexbox', 'When should I use CSS Grid and when should I use Flexbox?', 2),
(4, 'Database normalization explained', 'Can someone explain database normalization with real-world examples?', 4);

-- =====================================================
-- 12. INSERT FORUM_COMMENTS DATA
-- Replies/comments on forum threads
-- =====================================================
INSERT INTO forum_comments (thread_id, user_id, comment) VALUES
-- Comments on thread 1 (Python debugging)
(1, 2, 'Use pdb module for interactive debugging. It allows you to step through your code.'),
(1, 4, 'I prefer using VS Code with Python debugger extension. Very visual and easy to use.'),
(1, 5, 'Print statements are sometimes the best for quick debugging. Don\'t overcomplicate things!'),

-- Comments on thread 2 (Responsive design)
(2, 1, 'Mobile-first approach is the way to go. Always start with mobile design first.'),
(2, 3, 'Use media queries and flexible grid layouts. CSS Grid and Flexbox are your friends!'),
(2, 4, 'Don\'t forget about testing on actual devices, not just browser dev tools.'),

-- Comments on thread 3 (JavaScript closures)
(3, 1, 'Closures are functions that have access to variables from their outer scope.'),
(3, 5, 'Think of a closure as a function remembering the environment in which it was created.'),

-- Comments on thread 4 (SQL optimization)
(4, 2, 'Use indexes on columns that are frequently queried. It significantly improves performance.'),
(4, 5, 'Also consider query execution plans to understand where the bottleneck is.'),

-- Comments on thread 5 (React Hooks vs Classes)
(5, 3, 'Hooks are the modern way. React team recommends using functional components with hooks.'),
(5, 2, 'Hooks are cleaner and easier to test. Class components are becoming legacy.'),

-- Comments on thread 6 (Machine learning getting started)
(6, 1, 'Start with Andrew Ng\'s Machine Learning course on Coursera. It\'s excellent!'),
(6, 3, 'Learn Python, NumPy, and Pandas first before diving into ML libraries.'),

-- Comments on thread 7 (Mobile frameworks)
(7, 2, 'React Native is easier if you know JavaScript. Flutter has better performance though.'),
(7, 4, 'For cross-platform development, React Native is more popular in the industry.'),

-- Comments on thread 8 (CSS Grid vs Flexbox)
(8, 1, 'Grid for 2D layouts (rows and columns), Flexbox for 1D layouts (rows or columns).'),
(8, 5, 'You can use both together. Grid for overall layout, Flexbox for component alignment.'),

-- Comments on thread 9 (Database normalization)
(9, 3, 'Normalization reduces data redundancy and improves data integrity.'),
(9, 1, 'Remember: 1NF, 2NF, 3NF. Most databases are normalized to 3NF.');

-- =====================================================
-- 13. INSERT RESOURCES DATA
-- Course materials uploaded by tutors
-- =====================================================
INSERT INTO resources (tutor_id, course_id, title, file_path) VALUES
-- Jane Smith (tutor1) resources
(6, 1, 'Python Programming Guide PDF', '/uploads/python_guide.pdf'),
(6, 1, 'Variables Cheat Sheet', '/uploads/variables_cheatsheet.pdf'),
(6, 2, 'HTML5 Tutorial Document', '/uploads/html5_tutorial.pdf'),
(6, 2, 'CSS Best Practices', '/uploads/css_bestpractices.pdf'),
(6, 7, 'Mobile Development Roadmap', '/uploads/mobile_roadmap.pdf'),

-- Robert Taylor (tutor2) resources
(7, 3, 'JavaScript Complete Reference', '/uploads/js_reference.pdf'),
(7, 3, 'DOM API Cheat Sheet', '/uploads/dom_cheatsheet.pdf'),
(7, 5, 'React Documentation Summary', '/uploads/react_summary.pdf'),
(7, 5, 'Hooks Deep Dive', '/uploads/hooks_deepdive.pdf'),

-- Lisa Anderson (tutor3) resources
(8, 4, 'SQL Query Examples', '/uploads/sql_examples.pdf'),
(8, 4, 'Database Design Principles', '/uploads/db_design.pdf'),
(8, 6, 'Data Science Toolkit', '/uploads/ds_toolkit.pdf'),
(8, 6, 'Pandas Quick Reference', '/uploads/pandas_reference.pdf');

-- =====================================================
-- 14. INSERT INSTRUCTORS TABLE DATA
-- Detailed instructor profiles
-- =====================================================
INSERT INTO instructors (name, email, bio, institution, profile_image, user_id) VALUES
('Jane Smith', 'jane@example.com', 'Expert in Python, Web Development, and Mobile App Development with 10+ years of experience in tech education.', 'Turtlers Academy', NULL, 6),
('Robert Taylor', 'robert@example.com', 'JavaScript specialist and React expert. Passionate about helping developers master modern web technologies.', 'Turtlers Academy', NULL, 7),
('Lisa Anderson', 'lisa@example.com', 'Database architect and data science enthusiast. Dedicated to teaching practical SQL and data analysis skills.', 'Turtlers Academy', NULL, 8);

-- =====================================================
-- VERIFICATION QUERIES
-- Run these to verify the data has been inserted correctly
-- =====================================================
/*
-- Check user counts by role
SELECT role, COUNT(*) as count FROM users GROUP BY role;

-- Check enrollment counts
SELECT COUNT(*) as total_enrollments FROM enrollments;

-- Check quiz statistics
SELECT q.title, COUNT(qa.id) as attempts, AVG(qa.percentage) as avg_score
FROM quizzes q
LEFT JOIN quiz_attempts qa ON q.id = qa.quiz_id
GROUP BY q.id, q.title;

-- Check forum activity
SELECT COUNT(*) as threads FROM forum_threads;
SELECT COUNT(*) as comments FROM forum_comments;

-- Check top performers
SELECT u.full_name, COUNT(qa.id) as quizzes_taken, AVG(qa.percentage) as avg_score
FROM users u
LEFT JOIN quiz_attempts qa ON u.id = qa.user_id
WHERE u.role = 'student'
GROUP BY u.id, u.full_name
ORDER BY avg_score DESC;

-- Check course ratings
SELECT c.course_name, AVG(r.rating) as avg_rating, COUNT(r.id) as rating_count
FROM course c
LEFT JOIN ratings r ON c.id = r.course_id
GROUP BY c.id, c.course_name;

-- Check lessons per course
SELECT c.course_name, COUNT(l.id) as lesson_count
FROM course c
LEFT JOIN lesson l ON c.id = l.course_id
GROUP BY c.id, c.course_name;
*/

COMMIT;
