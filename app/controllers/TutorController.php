<?php

require_once __DIR__ . '/../../core/database.php';
require_once __DIR__ . '/../models/tutorModel.php';
require_once __DIR__ . '/../models/courseModel.php';
require_once __DIR__ . '/../models/resourceModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$tutorName = $_SESSION['tutor_name'] ?? "Dr. Smith";

$tutorData = getTutorProfile($conn, $tutorName);


if (!$tutorData) {
    $tutorData = [
        "name" => $tutorName,
        "institution" => "Turtlers Academy",
        // Use relative public asset path (resolved by base href in views)
        "image" => "assets/images/tutor.png",
        "id" => 0
    ];
}

$tutorProfile = [
    "name" => $tutorData['name'],
    "institution" => $tutorData['institution'],
    "image" => $tutorData['image']
];


$courseRow = getCourseByTutor($conn, $tutorProfile['name']);

$tutorCourse = [
    "title" => "No Course Assigned",
    "code" => "N/A",
    "enrolled" => []
];

$allStudents = [];

if ($courseRow) {
    $tutorCourse['title'] = $courseRow['course_name'];
    $tutorCourse['code'] = $courseRow['course_code']; 

  
    $studentsDB = getEnrolledStudentsForCourse($conn, $courseRow['id']);

    
    $allStudents = $studentsDB; 

    
    foreach ($studentsDB as $s) {
        $tutorCourse['enrolled'][] = $s['name'];
    }
}


$dbCourses = getAllCourses($conn);
$allCourses = [];
foreach ($dbCourses as $c) {
    $allCourses[] = [
        "title" => $c['course_name'],
        "tutor" => $c['instructor_name'],
        "image" => $c['course_image']
    ];
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    
    if ($action === 'view_students') {
        echo "<h3>Find Student</h3>";

      
        $globalStudents = getAllStudentsWithCourses($conn);

        echo "
        <div style='margin-bottom: 20px;'>
            <input type='text' id='studentSearch' onkeyup='filterStudents()' placeholder='Search student by name...' 
                   style='width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;'>
        </div>
        <div id='noStudentResults' style='display:none; text-align:center; padding: 20px; color: #888;'>No students found matching your search.</div>";

        echo "<table border='1' id='studentTable' style='width:100%; border-collapse:collapse; margin-top:10px;'>
                <tr style='background:#f4f7f6;'>
                    <th style='padding:12px;'>ID</th><th style='padding:12px;'>Name</th><th style='padding:12px;'>Course</th>
                </tr>";
        foreach ($globalStudents as $s) {
            echo "<tr class='student-row'>
                    <td style='padding:10px; text-align:center;'>{$s['id']}</td>
                    <td class='s-name' style='padding:10px;'>{$s['name']}</td>
                    <td style='padding:10px;'>{$s['course']}</td>
                  </tr>";
        }
        echo "</table>";
        exit;
    }

  
    if ($action === 'your_course') {
        echo "<h3>Manage: {$tutorCourse['title']}</h3>
              <p>Course Code: <b>{$tutorCourse['code']}</b></p>
              <h4>Enrolled Students:</h4><ul>";
        foreach ($tutorCourse['enrolled'] as $student) {
            echo "<li>$student</li>";
        }
        echo "</ul>";
        exit;
    }

   
    if ($action === 'course_settings') {
        echo "<h3>Course Management</h3>
              <div style='margin-top:20px;'>
                  <button style='background:#28a745; color:white; padding:10px; border:none; border-radius:5px; cursor:pointer;'>+ Add New Course</button>
                  <button style='background:#dc3545; color:white; padding:10px; border:none; border-radius:5px; cursor:pointer; margin-left:10px;'>- Delete Course</button>
              </div>";
        exit;
    }

    
    if ($action === 'upload_resource') {
       
        $tutorId = $tutorData['id'];
        $myResources = getResourcesByTutor($conn, $tutorId);

        echo "
        <div class='upload-container' style='background:white; padding:30px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.05);'>
            <h3>Upload Course Resources</h3>
            <p style='color:#666; margin-bottom:20px;'>Accepted formats: .pdf, .docx, .pptx</p>
            <form id='uploadForm' onsubmit='submitUpload(event)'>
                <input type='text' name='title' placeholder='Resource Title' required style='display:block; width:100%; padding:10px; margin-bottom:15px; border:1px solid #ddd; border-radius:6px;'>
                <input type='file' name='resource_file' required style='display:block; margin-bottom:20px;'>
                <button type='submit' style='background:#3a6cf4; color:white; border:none; padding:12px 25px; border-radius:8px; cursor:pointer; font-weight:600;'>Upload File</button>
            </form>
            <div id='status' style='margin-top:20px; font-weight:600;'></div>
        </div>
        
        <h3 style='margin-top:40px;'>My Uploaded Resources</h3>
        <table style='width:100%; border-collapse:collapse; margin-top:15px;'>
            <tr style='background:#f4f7f6; text-align:left;'>
                <th style='padding:10px;'>Title</th>
                <th style='padding:10px;'>Date</th>
                <th style='padding:10px;'>Action</th>
            </tr>";

        if (empty($myResources)) {
            echo "<tr><td colspan='3' style='padding:15px; text-align:center; color:#888;'>No resources uploaded yet.</td></tr>";
        } else {
            foreach ($myResources as $r) {
                echo "<tr>
                        <td style='padding:10px;'>{$r['title']}</td>
                        <td style='padding:10px;'>{$r['uploaded_at']}</td>
                        <td style='padding:10px;'>
                            <button onclick='deleteResource({$r['id']})' style='background:#e74c3c; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;'>Delete</button>
                        </td>
                      </tr>";
            }
        }
        echo "</table>
        
        <script>
        function deleteResource(id) {
            if(confirm('Are you sure you want to delete this resource?')) {
                fetch('../../controllers/TutorController.php?action=delete_resource&id=' + id)
                .then(r => r.text())
                .then(msg => {
                    alert(msg);
                    ajaxTutor('upload_resource'); // Reload view
                });
            }
        }
        </script>
        ";
        exit;
    }

   
    if ($action === 'process_upload') {
        if (isset($_FILES['resource_file']) && isset($_POST['title'])) {
            $fileName = $_FILES['resource_file']['name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['pdf', 'docx', 'pptx'];

            if (!in_array($fileExt, $allowed)) {
                echo "<span style='color:#e74c3c;'>Error: Invalid format. Only PDF, DOCX, and PPTX allowed.</span>";
            } else {
              
                $targetDir = __DIR__ . "/../../public/assets/uploads/resources/";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $newFileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
                $targetFile = $targetDir . $newFileName;
                // Store relative path for the uploaded resource (views will resolve via base href)
                $dbPath = "assets/uploads/resources/" . $newFileName;

                if (move_uploaded_file($_FILES['resource_file']['tmp_name'], $targetFile)) {
                   
                    $tutorId = intval($tutorData['id']);

                    if ($tutorId <= 0) {
                        echo "<span style='color:#e74c3c;'>Error: Cannot upload. Tutor Profile not found in database.<br>";
                        echo "Debug: Searching for '{$tutorName}'. Result ID: {$tutorId}.<br>";
                        echo "Please ensure you have run 'database/instructors_to_users.sql'.</span>";
                    } else {
                        
                        $courseId = 0;
                        if ($courseRow) {
                            $courseId = $courseRow['id'];
                        }

                        $result = addResource($conn, $tutorId, $courseId, $_POST['title'], $dbPath);
                        if ($result === true) {
                            echo "<span style='color:#2ecc71;'>Success: Resource uploaded successfully.</span>";
                        } else {
                            echo "<span style='color:#e74c3c;'>Error: Database insert failed. Detail: $result</span>";
                        }
                    }
                } else {
                    echo "<span style='color:#e74c3c;'>Error: File upload failed. Check permissions.</span>";
                }
            }
        }
        exit;
    }

    
    if ($action === 'delete_resource') {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $filePath = deleteResource($conn, $id);
            if ($filePath) {
               
                $fullPath = __DIR__ . "/../../.." . $filePath; 
               
                $sysPath = $_SERVER['DOCUMENT_ROOT'] . $filePath;
                if (file_exists($sysPath)) {
                    unlink($sysPath);
                }
                echo "Resource deleted.";
            } else {
                echo "Error deleting resource.";
            }
        }
        exit;
    }

   
    if ($action === 'view_all_courses') {
        echo "<h3>Available Courses</h3>
        <div style='margin-bottom: 20px;'>
            <input type='text' id='courseSearch' onkeyup='filterCourses()' placeholder='Search by course title...' 
                   style='width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;'>
        </div>
        <div id='noResultsMessage' style='display:none; text-align:center; padding: 40px; color: #888;'>No courses found.</div>
        <div class='course-grid' id='courseGrid' style='display:grid; grid-template-columns:repeat(auto-fill, minmax(230px, 1fr)); gap:25px;'>";
        foreach ($allCourses as $course) {
            echo "
            <div class='course-card' style='background:white; padding:15px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.05); text-align:center;'>
                <img src='{$course['image']}' style='width:100%; height:130px; object-fit:cover; border-radius:8px; margin-bottom:15px;'>
                <h4>{$course['title']}</h4>
                <p style='font-size:0.85rem; color:#666;'>Tutor: {$course['tutor']}</p>
            </div>";
        }
        echo "</div>";
        exit;
    }
}
?>