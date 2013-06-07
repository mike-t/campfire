<?php
// ====================================
// createMember
// ====================================
// Creates and updates member details
// from signup.php form input that is
// already validated client and sever side.
//
// Intended to be included in signup.php
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

function createMember($formdata) {

	// check for no drop down value on activity
	if (!isset($formdata['activity'])) $formdata['activity'] = null;

	// use prepared db query (although is performance overhead in single use cases)
	$sql = "INSERT INTO Members
			(member_email, member_firstname, member_lastname, member_password, member_dob, member_telephone, member_activity)
			VALUES
			(?, ?, ?, ?, ?, ?, ?)";

	// run the query
	$st = $GLOBALS['pdo']->prepare($sql);

	// run the query substituting values (store bcrypt hash of the password for security)
	$st->execute(array($formdata['email'], $formdata['firstname'], $formdata['lastname'], password_hash($formdata['password'],  PASSWORD_BCRYPT), $formdata['dob'], $formdata['telephone'], $formdata['activity']));

	// check for errors on statement
	if($st->errorCode() > 1) die("Error creating member: " . $st->errorInfo()[2]);

	return true;
}
?>
