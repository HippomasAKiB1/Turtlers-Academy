function selectTab(element) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => tab.classList.remove('active'));
    element.classList.add('active');
}
async function ajaxLoadAboutMe() {
    const res = await fetch(`/repo/Turtlers-Academy/app/controllers/dashboardController.php?action=aboutme`);
    const html = await res.text();
    document.getElementById('main-display').innerHTML = html;
}
async function ajaxLoadView(action) {
    const res = await fetch(`/repo/Turtlers-Academy/app/controllers/dashboardController.php?action=${action}`);
    const html = await res.text();
    document.getElementById('main-display').innerHTML = html;
    if (action === 'view_bookmarks' && typeof renderBookmarksPage === 'function') {
        renderBookmarksPage();
    }
}
async function ajaxLoadDetail(id) {
    const res = await fetch(`/repo/Turtlers-Academy/app/controllers/dashboardController.php?id=${id}`);
    const html = await res.text();
    document.getElementById('main-display').innerHTML = html;
}