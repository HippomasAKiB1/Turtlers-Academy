document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Time-based Greeting Logic
    const hour = new Date().getHours();
    let greeting = "Welcome";

    if(hour < 12) {
        greeting = "Good Morning";
    } else if(hour < 18) {
        greeting = "Good Afternoon";
    } else {
        greeting = "Good Evening";
    }

    // Target the specific greeting header in the first card
    const greetingElement = document.querySelector(".dashboard-card h3");
    if (greetingElement) {
        greetingElement.innerText = `${greeting}, Nazat`;
    }

    // 2. Dashboard Activity Logic (Example: Logging view)
    console.log("Dashboard loaded for user: Nazat");
});