// Timer Logic
document.addEventListener("DOMContentLoaded", function () {
    if (typeof TIME_LIMIT_MINUTES !== 'undefined' && TIME_LIMIT_MINUTES > 0) {
        startTimer(TIME_LIMIT_MINUTES * 60);
    } else {
        document.getElementById("timer-box").style.display = 'none';
    }
});

function startTimer(duration) {
    let timer = duration, minutes, seconds;
    let display = document.getElementById("timer");

    let interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(interval);
            alert("Time is up! Submitting quiz...");
            submitQuiz();
        }
    }, 1000);
}

function submitQuiz() {
    let quizId = document.getElementById("quiz_id").value;
    let answers = {};
    document.querySelectorAll("input[type=radio]:checked").forEach(r => {
        let qid = r.name.replace("q", "");
        answers[qid] = r.value;
    });

    // Allow empty submission if time is up (handled by backend or logic)
    // But for manual submit, validate:
    // (If called by timer, we might submit whatever is checked)

    let formData = new FormData();
    formData.append("quiz_id", quizId);
    formData.append("answers", JSON.stringify(answers));

    fetch("/Turtlers-Academy/public/ajax/submit_quiz.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            let resDiv = document.getElementById("result");
            if (data.status === "ok") {
                // Improve result display
                resDiv.innerHTML = `
                <div style="background:#e8fdf5; border:1px solid #2ecc71; padding:20px; text-align:center; margin-top:20px; border-radius:8px;">
                    <h2 style="color:#27ae60; margin:0 0 10px 0;">Quiz Completed!</h2>
                    <p style="font-size:1.2rem;">You scored <strong>${data.score}</strong> out of <strong>${data.total}</strong></p>
                    <div style="font-size:2rem; font-weight:bold; color:#2ecc71; margin:10px 0;">${data.percentage}%</div>
                    <button onclick="location.href='quiz.php'" style="padding:10px 20px; cursor:pointer;">Back to Quizzes</button>
                    <button onclick="location.reload()" style="padding:10px 20px; cursor:pointer;">Retake</button>
                </div>
            `;
                // Scroll to result
                resDiv.scrollIntoView({ behavior: "smooth" });
                // Disable form
                document.getElementById("quizForm").style.opacity = "0.5";
                document.getElementById("quizForm").style.pointerEvents = "none";

            } else if (data.status === "auth") {
                alert("You must be logged in to submit quiz.");
            } else {
                alert("Error submitting quiz.");
            }
        })
        .catch(err => console.error("Error:", err));
}

function validateQuiz() {
    let checked = document.querySelectorAll('input[type="radio"]:checked');
    if (checked.length === 0) {
        alert("Please answer at least one question.");
        return false;
    }
    return true;
}

