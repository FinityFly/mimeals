<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
?>


<!DOCTYPE HTML>
<!--
	Mimeals thing

	based off a template by:
	
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->


<html>
	<head>

	<!-- make title bigger -->
		<title>MiMeals | Dashboard</title>

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
									<p><b><a href="dashboard.php" class="logo">MiMeals</a></b> | <u>Dashboard</u></p>
									<ul class="icons">
										<!-- social media icons -->
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>
							<!-- Banner -->
								<section id="banner">
									<div>
										<header>
											<h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
											<p>Time to make your life a bit easier!</p>
										</header>
										<p>Welcome to our meal planning app! We're excited to help you take the guesswork out of mealtime and simplify your life. With our app, you can easily plan your meals for the week, create shopping lists, and discover new recipes that fit your dietary needs and preferences. Whether you're a busy professional, a health-conscious individual, or simply looking to save time and money, we've got you covered. Our user-friendly interface and customizable options make it easy for you to create a meal plan that works for you and your family. Get ready to take control of your meals and start enjoying stress-free, delicious meals today!</p>
										<!-- <ul class="actions">
											<li><a href="meal-explorer.php" class="button big">Get Started</a></li>
										</ul> -->
									</div>
									<!-- <span class="image object right">
										<img src="images/gordon.jpeg" alt="" />
									</span> -->
								</section>
								




								<!-- options -->
								<section id="banner">
								

								</section>
								<div class ='row'>
								<div class="col-4 col-12-medium">
										<header class="major">
											<h2>Find a new meal</h2>
										</header>
										<div class="posts" style = 'margin: auto;'>
											<article>
												<a href="meal-explorer.php" class="image"><img src="images/search 2.jpg" alt="" /></a>
											</article>
										</div>
									</div>
									<div class="col-4 col-12-medium">
										<header class="major">
											<h2>View my saved meals</h2>
										</header>
										<div class="posts" style = 'margin: auto;'>
											<article>
												<a href="meal-recipes.php" class="image"><img src="images/bookmark.jpg" alt="" /></a>
											</article>
										</div>
									</div>
									<div class="col-4 col-12-medium">
										<header class="major">
											<h2>Plan a meal</h2>
										</header>
										<div class="posts" style = 'margin: auto;'>
											<article>
												<a href="meal-calendar.php" class="image"><img src="images/calendarPic.jpg" alt="" /></a>
											</article>
										</div>
									</div>
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
										<li><a href="dashboard.php">Dashboard</a></li>
										<li><a href="meal-calendar.php">Calendar</a></li>
										<li><a href="meal-explorer.php">Explorer</a></li>
										<li><a href="meal-recipes.php">Recipes</a></li>
										<li><a href="includes/logout.php">Log out</a></li>
										<!-- <li>
											<span class="opener">Another Submenu</span>
											<ul>
												<li><a href="#">Lorem Dolor</a></li>
												<li><a href="#">Ipsum Adipiscing</a></li>
											</ul>
										</li> -->
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

<?php
} else {
	header("Location: index.php");
}
?>