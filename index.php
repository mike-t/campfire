<?php
// ====================================
// Index
// ====================================
// A splash page welcoming users to Campfire
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// include our custom php libraries 
require $_SERVER['DOCUMENT_ROOT'].'/utils/libraries.php';

// set the welcome background
$welcome = true;

//include the page header
require $_SERVER['DOCUMENT_ROOT'].'/template/_header.php';
?>
				<div class="row welcome-text">
					<h1>go camping!</h1>
					<ol>
						<li><span>join campfire</span></li>
						<li><span>find a campsite or walking trail</span></li>
						<li><span>share your experience!</span></li>
					</ol>
				</div>
<?php
// include the page footer
require $_SERVER['DOCUMENT_ROOT'].'/template/_footer.php';
?>
