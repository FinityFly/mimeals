<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

// get recipes from DB, now
?>






<!DOCTYPE HTML>

<html>
	<head>
		<title >MiMeals | Calendar</title >
		<link rel="icon" type="image/x-icon" href="./images/mimealsfavicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
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

							<!-- Future Meals (TODO)-->
							
							
							<!-- <section>
								<span class="image fit"><h1>Upcoming Planned Meals</h1>
								<div class = 'row'>
									
									<div class="col-6 col-12-small">
									
										<div class="row">
											<div class="col-12-small">
												<span class="image fit"><h2>June 1, 2023</h2>
											</div>
											
										</div>
										<div class="col-3">
											<span class="image fit"><h2>Bratwurst</h2>
											<a href="${redirect}"><span class="image"><img src="images/bratwurst.png" alt="" /></span></a>
											
										</div>
										
										<ul class="actions fit" style="font-size: 12px">
											<li><a href="${redirect}" class="button primary fit icon solid fa-eye">View Recipe</a></li>
											<li><a id="addRecipe" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Add Recipe</a></li>
											<li><a href="${recipe.sourceUrl}" class="button icon solid fa-search">Visit Website</a></li>
										</ul>
									</div>

								</div>
									
							</section> -->
							

							<section>
								<header class="main">
									<h1>Meal Calendar</h1>
								</header>

							<!-- Calendar Part -->
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

									<!-- Meal Plan Popup (Appears after Clicking a Date) -->
									<div class="date-popup">
										<a id="close" class="button small">Back</a>
										<h1 id="datestring"><h1>

										<!-- stuff all the saved recipes here -->
										<div class="recipe-list"></div>

										<!-- RECIPE LIST -->
										<a id="add-recipe" href="meal-recipes.php" class="button primary fit slim icon solid fa-plus">Add more recipes to this date</a>
										
									</div>
									<!-- overlay to also exit popup -->
									<div class = 'overlay' id="overlay"></div> 
								</div>
							</section>
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

							<!-- Menu-->
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
			<script type="module" src='assets/js/calendar.js'></script>

	</body>
</html>
<?php
} else {
	header("Location: index.php");}
?>
