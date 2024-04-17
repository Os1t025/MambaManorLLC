<style>
/* Styling for the popup */
.popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 40px; 
  border: 1px solid #ccc;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  width: 400px; 
  height: 600px; 
  text-align: center;
}

/* Styling for overlay */
.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 999;
}

/* Styling for form fields */
.form-field {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
}

.form-field label {
  align-self: flex-start;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-field input[type="text"],
.form-field input[type="email"],
.form-field input[type="password"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f2f2f2;
}
/* Styling for buttons */
.button {
  background-color: #4F772D;
    color: white;
    padding: 10px 50px;
    border: none;
    cursor: pointer;
}

.button:hover {
  background-color: #31572C;
}

.indicator {
  position: absolute;
  bottom: 0;
  height: 3px;
  background-color: #132A13; /* Red color */
  transition: width 0.3s ease, left 0.3s ease; /* Smooth transition */
}

.button-container {
  position: relative; /* Required for positioning the indicator */
}

</style>

<div class="overlay" id="overlay" onclick="closePopup()"></div>

<div class="popup" id="popup">
  <h2>Welcome to MambaManor</h2>
  
  <div class="button-container">
    <button class="button active" onclick="showSignupPanel()">Sign Up</button>
    <button class="button" onclick="showLoginPanel()">Login</button>
    <div class="indicator"></div> <!-- Indicator bar -->
  </div>
  
  <div id="signup-panel" style="display:none;">
  <h3>Sign Up</h3>
  <form id="signup-form" action="data.php" method="POST" onsubmit="return validateSignup()">
    <div class="form-field">
      <label for="signup-username">Username:</label>
      <input type="text" id="signup-username" name="username" placeholder="Enter your username">
    </div>
    <div class="form-field">
      <label for="signup-email">Email:</label>
      <input type="email" id="signup-email" name="email" placeholder="Enter your email">
    </div>
    <div class="form-field">
      <label for="signup-password">Password:</label>
      <input type="password" id="signup-password" name="password" placeholder="Enter your password">
    </div>
    <div class="form-field">
      <label for="signup-confirm-password">Confirm Password:</label>
      <input type="password" id="signup-confirm-password" name="confirmPassword" placeholder="Confirm your password">
    </div>
  <button type="submit" class="button">Sign Up</button>
  </div>
</form>
  
<div id="login-panel" style="display:none;">
  <h3>Login</h3>
  <form id="login-form" action="data2.php" method="POST" onsubmit="return validateLogin()">
    <div class="form-field">
      <label for="login-username">Username:</label>
      <input type="text" id="login-username" name="login-username" placeholder="Enter your username">
    </div>
    <div class="form-field">
      <label for="login-password">Password:</label>
      <input type="password" id="login-password" name="login-password" placeholder="Enter your password">
    </div>
    <button type="submit" class="button">Login</button>
  </div>
  </form>
</div>
