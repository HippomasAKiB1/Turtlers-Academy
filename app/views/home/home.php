<?php include "../app/views/partials/header.php"; ?>


<section class="hero-section" style="
    text-align: center; padding: 80px 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin-bottom: 50px;
">
    <h1 style="font-size: 3rem; font-weight: 800; color: #111; margin-bottom: 20px;">
        Welcome to <span style="color: #ff7b00;">Turtlers Academy</span>
    </h1>
    <p style="font-size: 1.2rem; color: #555; max-width: 600px; margin: 0 auto 30px;">
        Unlock your potential with our expert-led courses. Join a community of learners and achieve your goals today.
    </p>
    <a href="course.php" style="
        display: inline-block; padding: 15px 30px; background: #ff7b00; color: white;
        text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem;
        transition: transform 0.2s; box-shadow: 0 5px 15px rgba(255, 123, 0, 0.3);
    " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        Discover Courses
    </a>
</section>


<section id="courses" style="max-width: 1200px; margin: 0 auto 80px; padding: 20px;">
    <div class="section-header" style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 2.2rem; font-weight: 700; color: #111;">Discover Our Courses</h2>
        <p style="color: #777; margin-top: 10px;">Explore a wide range of topics curated for you.</p>
    </div>

   
    <link rel="stylesheet" href="assets/css/coursegrid_style.css">

    <div class="course-grid">
        <?php foreach ($courses as $course): ?>
            <div class="course-box" data-id="<?= $course['id'] ?>">
                <h3><?= htmlspecialchars($course['name']) ?></h3>
                <p><?= htmlspecialchars($course['short_description']) ?></p>
                <div style="margin-top: 15px; display: flex; gap: 10px;">
                    <button class="enroll-btn" onclick="location.href='enroll.php?id=<?= $course['id'] ?>'"
                        style="flex:1;">Enroll Now</button>
                    <button class="details-btn" style="flex:1; background: #eee; color: #333;">Details</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<section id="tutors" style="background: #fdfdfd; padding: 80px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="section-header" style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.2rem; font-weight: 700; color: #111;">Get Introduced to Our Tutors</h2>
            <p style="color: #777; margin-top: 10px;">Learn from the best in the industry.</p>
        </div>

        <div style="
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;
        ">
            <?php foreach ($tutors as $tutor): ?>
                <div style="
                    background: white; padding: 30px; border-radius: 12px;
                    border: 1px solid #eee; text-align: center;
                    transition: all 0.3s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.03);
                " onmouseover="this.style.transform='translateY(-5px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    <div style="
                        width: 80px; height: 80px; background: #ff7b00; color: white;
                        border-radius: 50%; display: flex; align-items: center; justify-content: center;
                        font-size: 2rem; font-weight: 700; margin: 0 auto 20px;
                    ">
                        <?= strtoupper(substr($tutor['fullname'], 0, 1)) ?>
                    </div>
                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; color: #333;">
                        <?= htmlspecialchars($tutor['fullname']) ?></h3>
                    <p style="color: #888; font-size: 0.9rem;">Expert Tutor</p>
                    <p style="color: #666; font-size: 0.9rem; margin-top: 10px;"><?= htmlspecialchars($tutor['email']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<div id="course-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div id="popup-body"></div>
    </div>
</div>
<script src="assets/js/course_script.js"></script>

<?php include "../app/views/partials/footer.php"; ?>