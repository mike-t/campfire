<?php
// ====================================
// Anonymous PDO DB connector
// ====================================
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// DB Connection Settings
$hostname = 'localhost';
$dbname = 'social';

// connect to the DB
try {
	$pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname);
} catch(PDOException $e) {
	die("Error connecting to the database: " . $e->getMessage());
}
?>
