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


// test
// $DairyFree = 'checked';
$recipeTitle = '';
$DairyFree = '';
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
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

		<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
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
										<hr>
									</header>

									<body>
										<ul class="actions fit">
											<li><button id = 'create-meal' class = 'primary large icon solid fa-plus'>Create a recipe</button></li>
											<li><a href="meal-explorer.php" class = 'button large icon solid fa-search' style = 'text-align:center'>Explorer</a></li>
										</ul>
									</body>
									
									<!-- Load Recipes -->
									<div class="row"></div>

								</section>
								<!-- Meal popup -->
								<div class="meal-popup">
									<a id="close" class="button small">Back</a>
									<h1>Make a Custom Recipe<h1>
									<!-- <img src = 'images/preloader.gif'> -->
									<form>
										<!-- Modal body -->
										<div>
											<!-- text -->
											<div class="recipe-form">
												<div class="input-field">
													<input type="text" placeholder="Recipe Title" id = 'recipeTitle' required="required">
												</div>
												<div class="input-field">
													<textarea id="recipeDescription" placeholder="Enter your recipe description" id = 'recipeDescription' rows="6"></textarea>
												</div>
												<!-- <input type = 'file' id = 'recipePhoto' name = 'recipePhoto' accept = 'image/png, image/jpeg'>
												<span class="image fit"><img id="imageOutput"/></span> -->

											
											<!-- stats -->
												<div class="row">
													<div class="col-6 col-12-small" style="text-align:center">
														<!-- prep time  -->
														<div class="input-field">
															<input type="number" placeholder="Preperation Time (days)" id = 'prepTimeDays' required="required" maxlength="2" size="2" min="0">
														</div>
														<div class="input-field">
															<input type="number" placeholder="Preperation Time (hours)" id = 'prepTimeHours' required="required" maxlength="2" size="2" min="0">
														</div>
														<div class="input-field">
															<input type="number" placeholder="Preperation Time (minutes)" id = 'prepTimeMins' required="required" maxlength="2" size="2" min="0">
														</div>
													</div>

													<div class="col-6 col-12-small" style="text-align:center">
														<!-- cook time -->
														<div class="input-field">
															<input type="number" placeholder="Cooking Time (days)" id = 'cookTimeDays' required="required" maxlength="2" size="2" min="0">
														</div>
														<div class="input-field">
															<input type="number" placeholder="Cooking Time (hours)" id = 'cookTimeHours' required="required" maxlength="2" size="2" min="0">
														</div>
														<div class="input-field">
															<input type="number" placeholder="Cooking Time (minutes)" id = 'cookTimeMins' required="required" maxlength="2" size="2" min="0">
														</div>
													</div>
												</div>

												<!-- Ingredients List -->
												<div class="input-field">
													<textarea id="ingredients" placeholder="Enter your recipe ingredients" rows="6"></textarea>
												</div>
												<!-- price per serving and number of servings -->
												<div class="input-field">
													<input type="number" placeholder="Number of Servings" id = 'numServings' required="required" maxlength="2" size="2" min="0">
												</div>
												<div class="input-field">
													<input type="number" placeholder="Price per Serving ($)" id = 'priceServing' required="required" maxlength="2" size="2" min="0">
												</div>

												<!-- Recipe Steps -->
												<div class="input-field">
													<textarea id="recipeSteps" placeholder="Enter your recipe steps" rows="6"></textarea>
												</div>
												
												<div class='row'>
													<div class="col-6 col-12-small">
														<input type="checkbox" id="dairyFree">
														<label for="dairyFree">Dairy Free</label>
													</div>
													<div class="col-6 col-12-small">
														<input type="checkbox" id="glutenFree">
														<label for="glutenFree">Gluten Free</label>
													</div>
													<div class="col-6 col-12-small">
														<input type="checkbox" id="vegan" >
														<label for="vegan">Vegan</label>
													</div>
													<div class="col-6 col-12-small">
														<input type="checkbox" id="vegetarian" >
														<label for="vegetarian">Vegetarian</label>
													</div>
													<div class="col-6 col-12-small">
														<input type="checkbox" id="lowFODMAP" >
														<label for="Low FODMAP">Low FODMAP</label>
													</div>
												</div>
												
												<input type = 'file' id = 'recipePhoto' accept = 'image/png, image/jpeg'>
												<span class="image fit"><img id="imageOutput"/></span>

												<div class="login-button">
													<!-- uh maybe change to button -->
													<input type="submit" id ='save-meal' style="text-align:center" class = 'button primary'>
												</div>
										
											</div>
										</div>
									</form>
									
								
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