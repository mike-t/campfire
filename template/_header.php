<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">    
		<title>Campfire ~ the Australian camping community online.</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Campfire is a place to share the outdoors with like minded people. Share campsites, swap stories and chat around the campfire. Free to Join!">
		<meta name="keywords" content="camping australia, campfire, campsite review, campground review, camping search, campsite search, camping tips, camping help, bushwalking australia">
		<meta name="author" content="Michael Walton">

		<!-- provide html5 element support for old IE browsers -->
		<!--[if lt IE 9]>
			script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- include CSS, Bootstrap is understood and adapted by MW for INB271 -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/font.css" rel="stylesheet">
	</head>

	<body class="navbuffer <?= $welcome ? 'welcome-background' : 'standard-background'; ?>" id="top">

		<div class="wrapper">

			<?php require $_SERVER['DOCUMENT_ROOT'].'/template/_navbar.php' ?>
	  
			<div class="container">
