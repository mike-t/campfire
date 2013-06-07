<?php
// ====================================
// User Session Manager
// ====================================
// Manages users login session state.
// The login and logout functions are 
// called by other areas of the site.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// start / continue the session
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// check if the user login session exists, if not create it
if (!isset($_SESSION['user_logged_in'])) $_SESSION['user_logged_in'] = false;


// ====================================
// login
// ====================================
// takes user variables to be quickly used around the site without DB calls
// expects data to be validated prior to call
// ====================================
function login($username) {
	
	// grab user details from DB
	$st = $GLOBALS['pdo']->prepare('SELECT member_email, member_firstname, member_lastname FROM Members WHERE member_email LIKE :username LIMIT 1;', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$st->execute(array(':username' => $username));		
	
	// error handling
	if($st->errorCode() > 1) die("Error retrieving member details: " . $st->errorInfo()[2]);
	
	// grab the returned row
	$result = $st->fetch(PDO::FETCH_ASSOC);
	
	// set the session user variables
	$_SESSION['user_logged_in'] = true;
	$_SESSION['user_username'] = $result['member_email'];
	$_SESSION['user_firstname'] = $result['member_firstname'];
	$_SESSION['user_lastname'] = $result['member_lastname'];
}


// ====================================
// logout - destroy's session and it's variables
// ====================================
function logout() {
	session_destroy();
}


// ====================================
// checkCredentials - check a user's credentials, returns boolean
// ====================================
function checkCredentials($username, $password) {
	
	// grab user password hash from db if it exists	
	$st = $GLOBALS['pdo']->prepare('SELECT member_password FROM Members WHERE member_email LIKE :username LIMIT 1;', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$st->execute(array(':username' => $username));		
	
	// error handling
	if($st->errorCode() > 1) die("Error checking credentials: " . $st->errorInfo()[2]);
	
	// if there was no user matched return false
	if(!$st->rowCount()) return false;
	
	// grab the returned row
	$result = $st->fetch(PDO::FETCH_ASSOC);
	
	// validate hash and return boolean
	return password_verify($password, $result['member_password']);
}
?>
