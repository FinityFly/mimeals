<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>MiMeals | Forgot Password</title>
		<link rel="icon" type="image/x-icon" href="./images/mimealsfavicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
				<div id="main">
					<div class="inner">
						<!-- Header -->
						<header id="header">
							<a href="index.php" class="logo"><strong>MiMeals</strong></a>
							<ul class="icons">
								<!-- social media icons -->
								<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							</ul>
						</header>

						<!-- User enters email to reset password -->
						<div class="login-form">
							<form action="includes/reset-request.php" method="POST">
								<p>UH OH...</p>
								<h1>Forgot your password?</h1>
								<div class="input-field">
									<input type="text" placeholder="email" name="email-input" required="required">
								</div>
								<p>An email will be sent to your inbox to reset your password</p>
								<div class="login-button">
									<button type="submit" id="reset-button" href="#">Send email</button>
								</div>
								<?php 
								if (isset($_GET['reset'])) {
									if ($_GET['reset'] == "success") {
										echo '<p class="box">Email sent successfully, check your email!</p>';
									} else if ($_GET['reset'] == "error") {
										echo '<p class="box">Something went wrong, try again</p>';
									} else {
										echo '<p class="box">' . $_GET['reset'] . '</p>';
									}
								}
								?>
								<p class="message">
									Try to login? <a href="guest-login.php">login to your account</a>
								</p>
							</form>
						</div>

					</div>
				</div>

				<!-- Sidebar -->
				<div id="sidebar">
					<div class="inner">

						<!-- Search -->
							<section id="search" class="alt">
								<form method="post" action="#">
									<input type="text" name="query" id="query" placeholder="Search" />
								</form>
							</section>

						<!-- Menu -->
							<nav id="menu">
								<header class="major">
									<h2>Menu</h2>
								</header>
								<ul>
									<li><a href="index.php">Homepage</a></li>
									<li><a href="guest-explorer.php">Explore</a></li>
									<li><a href="guest-login.php">Login</a></li>
									<li><a href="guest-signup.php">Sign Up</a></li>
								</ul>
							</nav>


						<!-- Footer -->
							<footer id="footer">
								<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
							</footer>

					</div>
				</div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>