// Handle Sign-In submission via AJAX
async function handleSignIn(event) {
    event.preventDefault(); // Prevent default form submission

    // Clear previous errors
    document.getElementById("email-error").textContent = "";
    document.getElementById("password-error").textContent = "";

    const form = event.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        // Send AJAX request to signin.php
        const response = await fetch("signin.php", {
            method: "POST",
            body: new URLSearchParams(data),
        });

        const result = await response.json();

        if (result.success) {
            // Redirect on successful login
            window.location.href = "home.php"; // Redirect to logged-in homepage
        } else {
            // Display errors under appropriate fields
            if (result.error.includes("Email")) {
                document.getElementById("email-error").textContent = result.error;
            } else if (result.error.includes("password")) {
                document.getElementById("password-error").textContent = result.error;
            }
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred. Please try again later.");
    }
}