function toggleVisibilityForSignupContent() {
    var signupContent = document.getElementById("signupContent");
    var signupButton = document.getElementById("signupButton");
    var computedStyle = window.getComputedStyle(signupContent);
    var currentDisplayStyle = computedStyle.getPropertyValue("display");

    if (currentDisplayStyle === "none") {
        signupContent.style.display = "block";
        signupButton.style.display = "none";
    } else {
        signupContent.style.display = "none";
        signupButton.style.display = "block";
    }
}


function toggleVisibilityForLoginContent() {
    var LoginContent = document.getElementById("Login");
    var LoginButton = document.getElementById("loginButton");
    var computedStyle = window.getComputedStyle(LoginContent);
    var currentDisplayStyle = computedStyle.getPropertyValue("display");

    if (currentDisplayStyle === "none") {
        LoginContent.style.display = "block";
        LoginButton.style.display = "none";
        toggleVisibilityForSignupContent();
    } else {
        LoginContent.style.display = "none";
        LoginButton.style.display = "block";
        toggleVisibilityForSignupContent();
    }
}
document.getElementById("loginButton").addEventListener("click", toggleVisibilityForLoginContent);

function openLink() {
    // Change the URL to the link you want to open
    var linkToOpen = "http://localhost:3000/login.php";

    // Open the link in the current window
    window.location.href = linkToOpen;
}

function openLink2() {
    // Change the URL to the link you want to open
    var linkToOpen = "http://localhost:3000/signup.html";

    // Open the link in the current window
    window.location.href = linkToOpen;

}



