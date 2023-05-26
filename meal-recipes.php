<?php
session_start();

include 'includes/db-conn.php';
$userId = $_SESSION['id'];

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

// from the added recipes db, retrieve the recipe data from entries that have the same user ID as the current user
// $sql = "SELECT * FROM `addedRecipes` WHERE userId = '$userId'";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// print_r($row);

?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>MiMeals | Recipes</title>
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
								<a href="index.php" class="logo"><b>MiMeals</b></a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<!-- Content -->
								<section>
									<header class="main">
										<h1>Saved Recipes</h1>
										<h5>View your saved meals here </h5>
										<div>

										</div>
										<hr>
									</header>



									<!-- get saved recipes -->
									<!-- for recipe in saved recipes, display: -->

									<!-- image of food, aligned left, food name to the right -->
									<!-- alt : mimeals empty dish photo: a dashed line black and white picture of a bowl of rice/salad/burger/eating utensil -->

									<body>
										<ul class="actions fit">
											<button id = 'create-meal' class = 'primary large icon solid fa-plus'>Create a meal?</button>

											<a href="meal-explorer.php" class = 'button large icon solid fa-search'>Explorer</a></li>
										</ul>
									</body>

									<!-- sort options top right and load more columns -->

									<!-- display recipes -->
									<!-- add an indent to the right -->
									
									<div class="row"></div>


								</section>

								<!-- Create Custom Meal Popup -->
								<div class="meal-popup">
									<a id="close" class="button small">Back</a>
									<h1>Make a Custom Recipe<h1>
									<div class="input-field" id = 'um'>
											<!--name vs id??-->
										<input type="text" placeholder="Meal Name" name="name-input" required="required">
									</div>
									<input type = 'file' id = 'recipePhoto' name = 'recipePhoto' accept = 'image/png, image/jpeg'>
									<span class="image fit"><img id="imageOutput"/></span>
									<!-- 	https://www.youtube.com/watch?v=EaBSeNSc-2c&t=0s		https://www.youtube.com/watch?v=lzK8vM_wdoY			 -->
									<!-- https://medium.com/@mignunez/how-to-upload-and-preview-an-image-with-javascript-749b92711b91																								  -->


									<!--ensure it is centered -->
									<a id = 'saveRecipe' class = 'button primary'> Save Meal </a>
								</div>

								<div class="calendar-popup">
									<a id="close" class="button small">Back</a>
									<h1>Recipe Adder<h1>
									<div class="calendar-wrapper">
										<div class="calendar-header">
											<h1 class="current-date"></h1>
											<div class="icons">
												<span id="prev" class="material-symbols-rounded">chevron_left</span>
												<span id="next" class="material-symbols-rounded">chevron_right</span>
											</div>
										</div>
										<div class="calendar">
											<ul class="weeks">
												<li>Sun</li>
												<li>Mon</li>
												<li>Tue</li>
												<li>Wed</li>
												<li>Thu</li>
												<li>Fri</li>
												<li>Sat</li>
											</ul>
											<ul class="days"></ul>
										</div>
									</div>
								</div>
								<!-- Overlay -->
								<div class = 'overlay' id="overlay"></div> 
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
									</ul>
								</nav>





							<!-- Section -->
								<section>
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
									<ul class="contact">
										<li class="icon solid fa-envelope"><a href="#">information@untitled.tld</a></li>
										<li class="icon solid fa-phone">(000) 000-0000</li>
										<li class="icon solid fa-home">1234 Somewhere Road #8254<br />
										Nashville, TN 00000-0000</li>
									</ul>
								</section>

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
			<script type="module" src='assets/js/meal-recipes.js'></script>

	</body>
</html>

<?php
} else {
	header("Location: index.php");
}
?>