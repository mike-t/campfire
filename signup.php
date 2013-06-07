<?php
// ====================================
// Member SignUp
// ====================================
// Members form with client and server
// side validation.
// Validated members will enter the db.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// include our custom php libraries and the page header
require $_SERVER['DOCUMENT_ROOT'].'/utils/libraries.php';
require $_SERVER['DOCUMENT_ROOT'].'/template/_header.php';

// check if the form needs to be shown or parsed (any form field isset will do...)
if (!isset($_POST['email']))  {
	
	// form not submitted yet, show signup form
	showSignUpForm();
	
}else{
	
	// initialise validation variables
	$error = false;
	$errorDesc = 'something';
	
	// form has been submitted, validate it in accordance with model (DB) - higher level validation has been done by javascript
	if (($_POST['email'] == '') || (strlen($_POST['email']) > 250)) {
		$error = true || $error;
	}
	if (($_POST['firstname'] == '') || (strlen($_POST['firstname']) > 250)) {
		$error = true || $error;
	}
	if (($_POST['lastname'] == '') || (strlen($_POST['lastname']) > 250)) {
		$error = true || $error;
	}
	if (($_POST['password'] == '') || (strlen($_POST['password']) > 250) || (strlen($_POST['password']) < 8)) {
		$error = true || $error;
	}
	if ($_POST['password-confirm'] !== $_POST['password']) {
		$error = true || $error;
	}
	if (strlen($_POST['dob']) > 10) {
		$error = true || $error;
	}
	if (strlen($_POST['telephone']) > 100) {
		$error = true || $error;
	}
	if ($_POST['terms'] != 'on') {		
		$error = true || $error;
	}
	
	if ($error) {		
		// there was a validation error, show the form again with the combined error description
		showSignUpForm($errorDesc);
	}else{
		// create the new member
		createMember($_POST);
		
		// show success message
		showSignUpSuccess();
		
		// log the user in and create user session
		login($_POST['email']);
		
		// redirect user to the activity page
		header('Location: http://' . $_SERVER['SERVER_NAME'] . '/activity.php');
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
// showSignUpSuccess - display a message to 
// tell the user they are now a member.
// ====================================
function showSignUpSuccess() {
	// display the message
	echo('				<div class=\"row\">
					
					<!-- SignUp Success Message========================= -->
					<div class=\"span10\">
						<h2><span class="ding">&amp;</span> Join Campfire</h2>
						<p class=\"lead\">You\'ve joined campfire, welcome! Loading recent activity...</p>
					</div>
					<!-- End SignUp Success Message===================== -->');
}

// ====================================
// showSignUpForm - displays the signup
// form with validation error if applicable
// ====================================
function showSignUpForm($error = '') {
	
	// format the error to match js errors
	if ($error !== '') {
		$error = "								<div class=\"alert error\" id=\"validation-error-box_username\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
									<strong>Error: </strong>{$error}
								</div>";
	}
	// display the form	
	echo('				<div class="row">
					
					<!-- Sign Up Form=============================== -->
					<div class="span10">
						<h2><span class="ding">&amp;</span> Join Campfire</h2>
						<p class="lead">Pop in your details below to join Campfire</p>

						<form name="signup-form" id="signup-form" action="signup.php" class="form-horizontal" method="post" onsubmit="return validateForm();" >
							
							<!-- Validation error messages go here -->
							<div id="validation-error-container">
							'.$error.'
							</div>
							
							<!-- First Name -->
							<div class="control-group">
								<label class="control-label" for="firstname">First Name*</label>
								<div class="controls">
									<input required type="text" id="firstname" name="firstname" class="input-medium" placeholder="First Name" onchange="fieldIsValid(this, \'name\');">
								</div>
							</div>
							
							<!-- Last Name -->
							<div class="control-group">
								<label class="control-label" for="lastname">Last Name*</label>
								<div class="controls">
									<input required type="text" id="lastname" name="lastname" class="input-medium" placeholder="Last Name" onchange="fieldIsValid(this, \'name\');">
								</div>
							</div>			

							<!-- Email address -->
							<div class="control-group">
								<label class="control-label" for="email">Email*</label>
								<div class="controls">
									<input required type="email" id="email" name="email" class="input-large" placeholder="your@email.com" onchange="fieldIsValid(this, \'email\');">
								</div>
							</div>
							
							<!-- password field -->
							<div class="control-group">
								<label class="control-label" for="password">Password*</label>
								<div class="controls">
									<input required type="password" id="password" name="password" class="input-medium" placeholder="Password" onchange="fieldIsValid(this, \'password\');">
								</div>
							</div>
							
							<!-- confirm pasword field -->
							<div class="control-group">
								<label class="control-label" for="password-confirm">Confirm Password*</label>
								<div class="controls">
									<input required type="password" id="password-confirm" name="password-confirm" class="input-medium" placeholder="Confirm Password" onchange="fieldIsValid(this, \'passwordmatch\', \'password\');">
								</div>
							</div>

							<!-- date of birth -->
							<div class="control-group">
								<label class="control-label" for="dob">Date of Birth</label>
								<div class="controls">
									<input type="date" id="dob" name="dob" class="input-medium" onchange="fieldIsValid(this, \'date\');">
								</div>
							</div>
							
							<!-- telephone -->
							<div class="control-group">
								<label class="control-label" for="telephone">Telephone</label>
								<div class="controls">
									<input type="tel" id="telephone" name="telephone" class="input-medium" onchange="fieldIsValid(this, \'telephone\');">
								</div>
							</div>

							<!-- profile picture -->
							<div class="control-group">
								<label class="control-label" for="avatar">Profile Picture</label>
								<div class="controls">
									<input type="file" id="avatar" name="avatar">
								</div>
							</div>
							
							<!-- favourite field -->
							<div class="control-group">
								<label class="control-label" for="activity">Favourite Activity</label>
								<div class="controls">
									<select id="activity" name="activity" class="input-medium">
										  <option value="" disabled selected>Select an Activity</option>
										 <option value="bushwalking">Bushwalking</option>
										 <option value="camping">Camping</option>										
									</select>
								</div>
							</div>							
							
							<!-- Terms and Conditions -->
							<div class="control-group">
								<div class="controls">
									<label class="checkbox">								
										<input required type="checkbox" id="terms" name="terms">&nbsp; I agree with the <a href="#">Terms and Conditions*</a>.
									</label>
									<p><small>* required field</small></p>
								</div>
							</div>		

							<!-- Submit button -->
							<div class="control-group">
								<div class="controls">
									<input type="submit" value="Sign up" class="btn btn-primary btn-large">
								</div>
							</div>
							
						</form>
						
					</div>
					<!-- End Sign Up Form=========================== -->');
}
?>
