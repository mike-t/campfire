<?php
// ====================================
// Activity
// ====================================
// displays site activity such as messages
// members and friends.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// include our custom php libraries and the page header
require $_SERVER['DOCUMENT_ROOT'].'/utils/libraries.php';
require $_SERVER['DOCUMENT_ROOT'].'/template/_header.php';
?>

				<div class="row">
					
					<!-- Recent Activity============================ -->
					<div class="span10">
						<h2><span class="ding">:</span> Recent Activity</h2>
						<p class="lead">What's been happening around your campfire?</p>
					</div>
					<!-- End Recent Activity======================== -->

<?php
// include the sidebar
require $_SERVER['DOCUMENT_ROOT'].'/template/_sidebar.php';
?>				
				</div>
				<!-- end row -->
<?php
// include the page footer
require $_SERVER['DOCUMENT_ROOT'].'/template/_footer.php';

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
