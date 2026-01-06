function submitQuiz() {
    let quizId = document.getElementById("quiz_id").value;
    let answers = {};
    document.querySelectorAll("input[type=radio]:checked").forEach(r=>{
        let qid = r.name.replace("q","");
        answers[qid] = r.value;
    });

    if(Object.keys(answers).length===0){
        alert("Please answer all questions");
        return;
    }

    let formData = new FormData();
    formData.append("quiz_id", quizId);
    formData.append("answers", JSON.stringify(answers));

    fetch("../ajax/submit_quiz.php", {
        method:"POST",
        body:formData
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status==="ok"){
            document.getElementById("result").innerHTML=
            `Score: ${data.score}/${data.total} (${data.percentage}%)`;
        } else if(data.status==="auth"){
            alert("You must be logged in to submit quiz.");
        } else {
            alert("Error submitting quiz.");
        }
    });
}

function validateQuiz() {
    let checked = document.querySelectorAll('input[type="radio"]:checked');

    if (checked.length === 0) {
        alert("Please answer at least one question.");
        return false;
    }
    return true;
}

