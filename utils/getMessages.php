<?php
// ====================================
// getComments
// ====================================
// Gets 10 latest comments from DB 
// and displays them.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// connect to the db, include the user session manager
include $_SERVER['DOCUMENT_ROOT'].'/utils/db.php';
include $_SERVER['DOCUMENT_ROOT'].'/utils/user.php';

// db query
$sql = "SELECT m.member_email, m.member_firstname, m.member_lastname, ms.message_content, ms.message_posted
		FROM Messages ms
		INNER JOIN Members m ON ms.member_id = m.member_id
		ORDER BY ms.message_posted DESC
		LIMIT 10;";

// run the query
$result = $pdo->query($sql);

// error handling
if(!$result) die("Error getting messages: " . implode(":", $pdo->errorInfo()));

// set fetch mode
$result->setFetchMode(PDO::FETCH_ASSOC);

// display results if any
if ($result->rowCount() > 0) {
	// fetch each row as an array
	while($row = $result->fetch()) {
		print_r($row);
	}	
}else{
	// no results
	echo('No messages posted.');
}
?>
