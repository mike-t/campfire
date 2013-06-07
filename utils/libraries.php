<?php
// ====================================
// Libraries
// ====================================
// includes all libraries, functions and
// tools to be used throughout the site.
// included on every page.
//
// Author: Michael Walton
// Updated: 06/06/2013
// ====================================

// flag to display welcome background or not
$welcome = false;

// include password_hash compatibility PHP < 5.5 (this is builtin to PHP >=5.5)
// Source: https://github.com/ircmaxell/password_compat
// Not to be considered 3rd party as it is included in current versions of PHP
require $_SERVER['DOCUMENT_ROOT'].'/utils/password.php';

// connect to the db
require $_SERVER['DOCUMENT_ROOT'].'/utils/db.php';

// include the user session manager
require $_SERVER['DOCUMENT_ROOT'].'/utils/user.php';

// include the member creation function
require $_SERVER['DOCUMENT_ROOT'].'/utils/createMember.php';

?>
