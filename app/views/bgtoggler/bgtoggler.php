<?php
// Compute public path for assets
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = preg_replace('#/public.*$#', '', $scriptName);
if ($basePath === '/' || $basePath === '\\') {
    $basePath = '';
}
$publicPath = $basePath . '/public';
?>
<html>

<head>
    <title>Background color toggler</title>
    <link rel="stylesheet" href="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/css/bgtoggler.css">
</head>

<body>
    <section class="theme-section">
        <button id="themeToggle" class="theme-btn"></button>
    </section>
    <script src="<?= htmlspecialchars($publicPath, ENT_QUOTES, 'UTF-8') ?>/assets/js/bgtoggler.js"></script>
</body>

</html>