			<!-- Navbar  ============================================== -->
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" data-toggle="tooltip" title="Share campsites, swap stories and chat around the campfire." href="/">&nbsp; Campfire</a>
						<div class="nav-collapse collapse" id="main-menu">
							<ul class="nav" id="main-menu-left">
								<li><a href="#">Recent Activity</a></li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Bushwalking <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a target="_blank" href="#">Search Bushwalks</a></li>
										<li><a target="_blank" href="#">Highest Rated Bushwalks</a></li>
										<li class="divider"></li>
										<li><a target="_blank" href="#">Bushwalking 101 - A Beginner's Guide</a></li>
										<li><a target="_blank" href="#">Bushwalking Tips & Videos</a></li>
									</ul>
								</li>								
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Camping <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a target="_blank" href="#">Search Campsites</a></li>
										<li><a target="_blank" href="#">Highest Rated Campsites</a></li>
										<li class="divider"></li>
										<li><a target="_blank" href="#">Camping 101 - A Beginner's Guide</a></li>
										<li><a target="_blank" href="#">Camping Tips & Videos</a></li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right" id="main-menu-right">
<?php 
if (!$_SESSION['user_logged_in']) {
	echo('								<li><a data-toggle="tooltip" href="login.php" title="I\'m back!"><i class="icon-heart icon-white"></i> Login</a></li>');
	echo('								<li><a data-toggle="tooltip" href="signup.php" title="Join the Campfire Community!">Join Campfire <i class="icon-share-alt icon-white"></i></a></li>');
}else{
echo('								<li class="dropdown">');
echo("									<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"><i class=\"icon-user icon-white\"></i> {$_SESSION['user_firstname']} {$_SESSION['user_firstname']} <b class=\"caret\"></b></a>");
echo('									<ul class="dropdown-menu">');
echo('										<li><a target="_blank" href="#"><i class="icon-comment"></i>Activity</a></li>');
echo('										<li><a target="_blank" href="#"><i class="icon-off"></i> Logout</a></li>');
echo('									</ul>');
echo('								</li>');
}
?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- End Navbar ======================================== -->
