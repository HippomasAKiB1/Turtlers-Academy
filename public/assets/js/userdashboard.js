document.addEventListener("DOMContentLoaded", function () {
    var h = new Date().getHours();
    var greet = "Welcome";

    if (h < 12) {
        greet = "Good Morning";
    } else if (h < 18) {
        greet = "Good Afternoon";
    } else {
        greet = "Good Evening";
    }

    var el = document.querySelector(".dashboard-card h3");
    if (el) {
        el.innerText = greet + ", Nazat";
    }
});