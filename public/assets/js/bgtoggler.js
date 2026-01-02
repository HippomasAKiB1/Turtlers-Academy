// background toggle
let savedTheme = localStorage.getItem("siteTheme");

if (savedTheme) {
    document.body.classList.add(savedTheme);
} else {
    document.body.classList.add("light-mode");
}

document.getElementById("themeToggle").addEventListener("click", function () {

    if (document.body.classList.contains("light-mode")) {
        document.body.classList.replace("light-mode", "dark-mode");
        localStorage.setItem("siteTheme", "dark-mode");
    } 
    else {
        document.body.classList.replace("dark-mode", "light-mode");
        localStorage.setItem("siteTheme", "light-mode");
    }
});