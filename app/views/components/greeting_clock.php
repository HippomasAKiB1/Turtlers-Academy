<?php
// Set timezone
date_default_timezone_set('Asia/Dhaka'); 

$hour = (int)date('H');
$greeting = "";

if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}

// Fallback: If no name is provided, just call them 'User'
$nameToShow = isset($displayName) ? $displayName : "User";
?>

<div class="greeting-widget" style="text-align: right; margin-bottom: 20px; padding: 10px; border-bottom: 1px solid #eee;">
    <h2 style="font-size: 1.2rem; color: #1a2a3a; font-family: 'Poppins', sans-serif;">
        <?php echo $greeting; ?>, <span style="color: #3a6cf4;"><?php echo $nameToShow; ?>!</span>
    </h2>
    <div id="live-clock" style="font-size: 0.9rem; color: #888; font-weight: 600; font-family: 'Poppins', sans-serif;">
        00:00:00 AM
    </div>
</div>

<script>
function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let ampm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12; 
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    const timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    document.getElementById('live-clock').innerHTML = timeString;
}
updateClock();
setInterval(updateClock, 1000);
</script>