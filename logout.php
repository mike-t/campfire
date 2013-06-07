<?php
// ====================================
// Member Logout
// ====================================
// capture and validate user credentials.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// include our custom php libraries and the page header
require $_SERVER['DOCUMENT_ROOT'].'/utils/libraries.php';
require $_SERVER['DOCUMENT_ROOT'].'/template/_header.php';

// check if user is already logged out
if (!$_SESSION['user_logged_in']) {
	
	// user is already logged out, display a message
	showLoggedOut();
		
} else {
	
	//logout
	logout();
	
	// reload this page to get clean template and show message.
	header('Location: http://' . $_SERVER['SERVER_NAME'] . '/logout.php');
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
// showLoggedOut - display a message to 
// a user who is already logged in
// ====================================
function showLoggedout() {
	// display the message
	echo("				<div class=\"row\">
					
					<!-- Logout Message============================== -->
					<div class=\"span10\">
						<h2><span class=\"ding\">6</span> Logout</h2>
						<p class=\"lead\">You have successully logged out.</p>
					</div>
					<!-- End Logout Message========================== -->");
}
?>
