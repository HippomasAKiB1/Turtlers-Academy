<link rel="stylesheet" href="assets/css/quiz.css">
<?php
// Compute public path
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = preg_replace('#/public.*$#', '', $scriptName);
if ($basePath === '/' || $basePath === '\\') {
    $basePath = '';
}
$publicPath = $basePath . '/public';
?>
<script src="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/js/quiz.js" defer></script>


<h2>Taking: <?= htmlspecialchars($quiz['title']) ?></h2>
<div id="timer-box" style="position:fixed; top:20px; right:20px; background:white; padding:10px 20px; border:2px solid #333; font-weight:bold; font-size:1.2rem; border-radius:8px;">
    Time Left: <span id="timer">00:00</span>
</div>

<script>
    const TIME_LIMIT_MINUTES = <?= intval($quiz['time_limit']) ?>; 
</script>



<form id="quizForm" onsubmit="return validateQuiz();">
    <input type="hidden" id="quiz_id" value="<?= $quiz_id ?>">

    <?php foreach ($questions as $q) { ?>
        <div class="question">
            <p><?= htmlspecialchars($q['question']) ?></p>

            <?php foreach (['a', 'b', 'c', 'd'] as $o) { ?>
                <label>
                    <input type="radio" name="q<?= $q['id'] ?>" value="<?= $o ?>">
                    <?= htmlspecialchars($q[$o]) ?>
                </label><br>
            <?php } ?>
        </div>
    <?php } ?>

    <button type="button" onclick="submitQuiz()">Submit Quiz</button>
</form>

<div id="result"></div>