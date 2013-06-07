<?php
// ====================================
// setMember
// ====================================
// Creates and updates member details
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// connect to the db and include password_hash compatibility PHP < 5.5 (this is builtin to PHP >=5.5)
include $_SERVER['DOCUMENT_ROOT'].'/utils/db.php';
include $_SERVER['DOCUMENT_ROOT'].'/utils/password.php';

// get user input
$member_email = 'tim.burr@gmail.com';
$member_firstname = 'Tim';
$member_lastname = 'Burr';
$member_password = password_hash('testing123', PASSWORD_BCRYPT);	// use BCRYPT password hashing

// validate user input
// xxxxxxxxxxxxxxxxx

// use prepared db query (although is performance overhead in single use cases)
$sql = "INSERT INTO Members
		(member_email, member_firstname, member_lastname, member_password)
		VALUES
		(?, ?, ?, ?)";

// run the query
$st = $pdo->prepare($sql);

// run the query
$st->execute(array($member_email, $member_firstname, $member_lastname, $member_password));

// check for errors on statement
if($st->errorCode() > 1) die("Error creating member: " . $st->errorInfo()[2]);

echo("Member '" . $member_firstname . ' ' . $member_lastname ."' created.");
?>
