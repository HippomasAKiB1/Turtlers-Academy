window.ajaxLoadAboutMe = function() {
    const displayArea = document.getElementById('main-display');
    console.log("About Me clicked");

    fetch('../../controllers/dashboardController.php?action=aboutme')
        .then(response => response.text())
        .then(html => {
            displayArea.innerHTML = html;
        })
        .catch(err => console.error("Error loading About Me:", err));
};

window.ajaxLoadDetail = function(courseId) {
    const displayArea = document.getElementById('main-display');
    fetch(`../../controllers/dashboardController.php?id=${courseId}`)
        .then(response => response.text())
        .then(html => {
            displayArea.innerHTML = html;
        });
};

window.selectTab = function(clickedBtn) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => tab.classList.remove('active'));
    clickedBtn.classList.add('active');
};