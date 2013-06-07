<?php
// ====================================
// Member Login
// ====================================
// capture and validate user credentials.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// include our custom php libraries and the page header
require $_SERVER['DOCUMENT_ROOT'].'/utils/libraries.php';
require $_SERVER['DOCUMENT_ROOT'].'/template/_header.php';

// check if user is already logged in
if ($_SESSION['user_logged_in']) {
	
	// user is already logged in, display a message
	showLoggedIn();
	
} else {
	
	// user is not logged in, check if the form needs to be shown or parsed
	if (!isset($_POST['username']))  {
	
		// show login form
		showLoginForm();
		
	}else{
		
		// initialise validation variables (generic login error by design)
		$error = false;
		$errorDesc = 'Invalid username or password, please try again or <a href="signup.php">sign up!</a>';
		
		// form has been submitted, validate it in accordance with model (DB) - higher level validation has been done by javascript
		if (($_POST['username'] == '') || (strlen($_POST['username']) > 250)) $error = true || $error;
		if (($_POST['password'] == '') || (strlen($_POST['password']) > 250) || (strlen($_POST['password']) < 8)) $error = true || $error;
		
		if ($error) {
			// there was a validation error, show the form again with the error description
			showLoginForm($errorDesc); 
		}else{
			// form looks OK, check credentials;
			if (checkCredentials($_POST['username'], $_POST['password'])) {
				// login Success! call the login function to set their user session variables
				showLoggingIn();
				login($_POST['username']);
				// redirect user to the activity page
				header('Location: http://' . $_SERVER['SERVER_NAME'] . '/activity.php');
			} else {
				// failed validation, show form with same generic login error
				showLoginForm($errorDesc);
			}
		}
	}
}

// include the sidebar
require $_SERVER['DOCUMENT_ROOT'].'/template/_sidebar.php';
?>				
				</div>
				<!-- end row -->
<?php
// include the page footer
require $_SERVER['DOCUMENT_ROOT'].'/template/_footer.php';

// ====================================
// showLoggedIn - display a message to 
// a user who is already logged in
// ====================================
function showLoggedIn() {
	// display the message
	echo("				<div class=\"row\">
					
					<!-- Login Message=============================== -->
					<div class=\"span10\">
						<h2><span class=\"ding\">6</span> Login</h2>
						<p class=\"lead\">You are already logged in!</p>
					</div>
					<!-- End Login Message=========================== -->");
}

// ====================================
// showLoggingIn - display a message to 
// tell the user they are logged in and
// we are loading the activity page
// ====================================
function showLoggingIn() {
	// display the message
	echo("				<div class=\"row\">
					
					<!-- Logging in Message=========================== -->
					<div class=\"span10\">
						<h2><span class=\"ding\">6</span> Login</h2>
						<p class=\"lead\">Login successful, loading recent activity...</p>
					</div>
					<!-- End Logging in Message======================= -->");
}

// ====================================
// showLoginForm - display's the login form 
// with validation error if applicable
// ====================================
function showLoginForm($error = '') {
	
	// format the error to match js errors
	if ($error !== '') {
		$error = "								<div class=\"alert error\" id=\"validation-error-box_username\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
									<strong>Error: </strong>{$error}
								</div>";
	}
	
	// display the form
	echo("				<div class=\"row\">
					
					<!-- Login Form=============================== -->
					<div class=\"span10\">
						<h2><span class=\"ding\">6</span> Login</h2>
						<p class=\"lead\">Welcome back, please enter your email and password to continue.</p>

						<form name=\"login-form\" id=\"login-form\" action=\"login.php\" class=\"form-horizontal\" method=\"post\" onsubmit=\"return validateForm();\" >
							
							<!-- Validation error messages go here -->
							<div id=\"validation-error-container\">
								{$error}
							</div>
							
							<!-- Email address -->
							<div class=\"control-group\">
								<label class=\"control-label\" for=\"username\">Email*</label>
								<div class=\"controls\">
									<input required type=\"email\" id=\"username\" name=\"username\" class=\"input-large\" placeholder=\"your@email.com\" onchange=\"fieldIsValid(this, 'email');\">
								</div>
							</div>
							
							<!-- password field -->
							<div class=\"control-group\">
								<label class=\"control-label\" for=\"password\">Password*</label>
								<div class=\"controls\">
									<input required type=\"password\" id=\"password\" name=\"password\" class=\"input-medium\" placeholder=\"Password\" onchange=\"fieldIsValid(this, 'password');\">
								</div>
							</div>
							
							<!-- Submit button -->
							<div class=\"control-group\">
								<div class=\"controls\">
									<input type=\"submit\" value=\"Login\" class=\"btn btn-primary btn-large\">
								</div>
							</div>
							
						</form>
						
					</div>
					<!-- End Login Form=========================== -->");
}
?>
