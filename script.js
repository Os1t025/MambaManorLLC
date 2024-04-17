// JavaScript to make header follow on scroll
window.addEventListener('scroll', function() {
    var header = document.getElementById("header");
    var sticky = header.offsetTop;

    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
});

function togglePopup() {
  var popup = document.getElementById("popup");
  var overlay = document.getElementById("overlay");
  var signupPanel = document.getElementById("signup-panel");
  var loginPanel = document.getElementById("login-panel");
  
  // Display popup and overlay
  popup.style.display = "block";
  overlay.style.display = "block";
  
  // Display signup panel and hide login panel
  signupPanel.style.display = "block";
  loginPanel.style.display = "none";
}

function closePopup() {
  var popup = document.getElementById("popup");
  var overlay = document.getElementById("overlay");
  popup.style.display = "none";
  overlay.style.display = "none";
}

function showSignupPanel() {
  var signupPanel = document.getElementById("signup-panel");
  var loginPanel = document.getElementById("login-panel");
  var indicator = document.querySelector('.indicator');
  var signupButton = document.querySelector('.button:nth-child(1)'); // Select the first button
  signupPanel.style.display = "block";
  loginPanel.style.display = "none";
  indicator.style.width = signupButton.offsetWidth + 'px'; // Set indicator width to match button
  indicator.style.left = signupButton.offsetLeft + 'px'; // Set indicator position under the first button
}

function showLoginPanel() {
  var signupPanel = document.getElementById("signup-panel");
  var loginPanel = document.getElementById("login-panel");
  var indicator = document.querySelector('.indicator');
  var loginButton = document.querySelector('.button:nth-child(2)'); // Select the second button
  signupPanel.style.display = "none";
  loginPanel.style.display = "block";
  indicator.style.width = loginButton.offsetWidth + 'px'; // Set indicator width to match button
  indicator.style.left = loginButton.offsetLeft + 'px'; // Set indicator position under the second button
}

function validateSignup() {
  var username = document.getElementById("signup-username").value;
  var email = document.getElementById("signup-email").value;
  var password = document.getElementById("signup-password").value;
  var confirmPassword = document.getElementById("signup-confirm-password").value;

  // Check if any field is blank
  if (username === "" || email === "" || password === "" || confirmPassword === "") {
    alert("Please fill in all fields.");
    return false;
  }

  // Check if email is valid
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Check if password matches confirm password
  if (password !== confirmPassword) {
    alert("Passwords do not match.");
    return false;
  }

  return true;
}

function validateLogin() {
  var username = document.getElementById("login-username").value;
  var password = document.getElementById("login-password").value;

  // Check if username or password is empty
  if (username === "" || password === "") {
    alert("Please fill in both username and password.");
    return false;
  }

  return true;
}

