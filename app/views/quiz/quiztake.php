<link rel="stylesheet" href="../../public/assets/css/quiz.css">
<script src="../../public/assets/js/quiz.js" defer></script>

<h2>Take Quiz</h2>

<form id="quizForm" onsubmit="return validateQuiz();">
    
<input type="hidden" id="quiz_id" value="<?= $quiz_id ?>">

<?php foreach ($questions as $q) { ?>
<div class="question">
    <p><?= htmlspecialchars($q['question']) ?></p>

    <?php foreach (['a','b','c','d'] as $o) { ?>
    <label>
        <input type="radio" name="q<?= $q['question_id'] ?>" value="<?= $o ?>">
        <?= htmlspecialchars($q[$o]) ?>
    </label><br>
    <?php } ?>
</div>
<?php } ?>

<button type="button" onclick="submitQuiz()">Submit Quiz</button>
</form>

<div id="result"></div>
