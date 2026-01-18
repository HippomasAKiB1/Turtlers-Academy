<!DOCTYPE html>
<html>

<head>
    <title>Enroll | <?= htmlspecialchars($course['course_name'] ?? $course['name'] ?? 'Course') ?></title>
    <link rel="stylesheet" href="/repo/Turtlers-Academy/public/assets/css/enroll_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #000;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .enroll-container {
            display: flex;
            max-width: 900px;
            margin: 50px auto;
            background: #111;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            overflow: hidden;
        }

        .course-info {
            flex: 1;
            background: #000;
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .course-info h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .course-info p {
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-section {
            flex: 1.2;
            padding: 40px;
        }

        .form-section h3 {
            margin-bottom: 25px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #000;
            color: white;
            border: 1px solid #fff;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #fff;
            color: #000;
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .popup.show {
            display: flex;
            opacity: 1;
        }

        .popup-content {
            background: #111;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            transform: scale(0.9);
            transition: transform 0.3s;
        }

        .popup.show .popup-content {
            transform: scale(1);
        }

        .checkmark {
            font-size: 4rem;
            color: #fff;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>

<body>

    <div class="enroll-container">
        <div class="course-info">
            <p>You are enrolling in:</p>
            <h2><?= htmlspecialchars($course['course_name'] ?? $course['name'] ?? 'Course') ?></h2>
            <p>Complete your registration to get instant access to all course materials, quizzes, and the student forum.
            </p>
            <p style="margin-top:20px; font-weight:600;">Price: FREE</p>
        </div>

        <div class="form-section">
            <h3>Student Registration</h3>
            <form id="enrollForm">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="phone" placeholder="Phone Number" required>

                <button type="submit">Complete Enrollment</button>
            </form>
        </div>
    </div>

    
    <div class="popup" id="successPopup">
        <div class="popup-content">
            <span class="checkmark">✔</span>
            <h2>Enrollment Successful!</h2>
            <p>Welcome to <strong><?= htmlspecialchars($course['course_name'] ?? $course['name'] ?? 'Course') ?></strong></p>
            <div style="margin-top:20px;">
                <button onclick="location.href='course.php'"
                    style="background:#000; color:#fff; border:1px solid #fff; margin-bottom:10px;">Back to Courses</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('enrollForm').addEventListener('submit', function (e) {
            e.preventDefault();
            let btn = this.querySelector('button');
            let originalText = btn.innerText;
            btn.innerText = "Processing...";
            btn.disabled = true;

            let formData = new FormData(this);
            formData.append('ajax', 1);

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
                .then(res => res.text()) 
                .then(text => {
                    try {
                        return JSON.parse(text); 
                    } catch (e) {
                        console.error("Server Error:", text);
                        throw new Error("Server returned invalid JSON: " + text.substring(0, 150) + "..."); 
                    }
                })
                .then(data => {
                    if (data.status === 'ok') {
                        document.getElementById('successPopup').classList.add('show');
                    } else {
                        alert("Error: " + data.message);
                        btn.innerText = originalText;
                        btn.disabled = false;
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Debug Error: " + err.message);
                    btn.innerText = originalText;
                    btn.disabled = false;
                });
        });
    </script>

</body>

</html>