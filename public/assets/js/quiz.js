document.addEventListener("DOMContentLoaded", function () {
    if (typeof TIME_LIMIT_MINUTES !== "undefined" && TIME_LIMIT_MINUTES > 0) {
        startTimer(TIME_LIMIT_MINUTES * 60);
    } else {
        var tBox = document.getElementById("timer-box");
        if (tBox) {
            tBox.style.display = "none";
        }
    }
});

function startTimer(duration) {
    var timer = duration;
    var minutes, seconds;
    var display = document.getElementById("timer");

    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(interval);
            alert("Time is up! Submitting quiz...");
            submitQuiz();
        }
    }, 1000);
}

function submitQuiz() {
    var qIdEl = document.getElementById("quiz_id");
    if (!qIdEl) return;
    var quizId = qIdEl.value;

    var answers = {};
    var radios = document.getElementsByTagName("input");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type == "radio" && radios[i].checked) {
            var qid = radios[i].name.replace("q", "");
            answers[qid] = radios[i].value;
        }
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var resDiv = document.getElementById("result");
            if (data.status == "ok") {
                var html = "";
                html += '<div style="background:#e8fdf5; border:1px solid #2ecc71; padding:20px; text-align:center; margin-top:20px; border-radius:8px;">';
                html += '<h2 style="color:#27ae60; margin:0 0 10px 0;">Quiz Completed!</h2>';
                html += '<p style="font-size:1.2rem;">You scored <strong>' + data.score + '</strong> out of <strong>' + data.total + '</strong></p>';
                html += '<div style="font-size:2rem; font-weight:bold; color:#2ecc71; margin:10px 0;">' + data.percentage + '%</div>';
                html += '<button onclick="location.href=\'quiz.php\'" style="padding:10px 20px; cursor:pointer;">Back to Quizzes</button>';
                html += '<button onclick="location.reload()" style="padding:10px 20px; cursor:pointer;">Retake</button>';
                html += '</div>';
                resDiv.innerHTML = html;
                resDiv.scrollIntoView({ behavior: "smooth" });

                var form = document.getElementById("quizForm");
                if (form) {
                    form.style.opacity = "0.5";
                    form.style.pointerEvents = "none";
                }
            } else if (data.status == "auth") {
                alert("You must be logged in to submit quiz.");
            } else {
                alert("Error submitting quiz.");
            }
        }
    };
    xhttp.open("POST", "/Turtlers-Academy/public/ajax/submit_quiz.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("quiz_id=" + quizId + "&answers=" + JSON.stringify(answers));
}

function validateQuiz() {
    var radios = document.getElementsByTagName("input");
    var checkedCount = 0;
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type == "radio" && radios[i].checked) {
            checkedCount++;
        }
    }
    if (checkedCount == 0) {
        alert("Please answer at least one question.");
        return false;
    }
    return true;
}
