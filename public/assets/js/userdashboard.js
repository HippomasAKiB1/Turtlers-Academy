document.addEventListener("DOMContentLoaded", function() {
    
    
    const hour = new Date().getHours();
    let greeting = "Welcome";

    if(hour < 12) {
        greeting = "Good Morning";
    } else if(hour < 18) {
        greeting = "Good Afternoon";
    } else {
        greeting = "Good Evening";
    }

    
    const greetingElement = document.querySelector(".dashboard-card h3");
    if (greetingElement) {
        greetingElement.innerText = `${greeting}, Nazat`;
    }

    
    console.log("Dashboard loaded for user: Nazat");
});