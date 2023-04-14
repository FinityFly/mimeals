<?php
if (isset($_GET['id'])) { 
	$id = $_GET['id'];
}	
?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>MiMeals | Meal Explorer</title>
		<link rel="icon" type="image/x-icon" href="./images/mimealsfavicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />

		<script>
			function makeBulletList(arr, id) {
				let ul = document.getElementById(id);
				let li = document.createElement('li');
				arr.forEach((element) => {
					li.innerHTML += `<b>${element.amount} ${element.measures.metric.unitShort}</b> ${element.originalName.toLowerCase()}`;
					ul.appendChild(li);
					li = document.createElement('li');
				});
			}

			function makeOrderedList(arr, id) {
				let ol = document.getElementById(id);
				let li = document.createElement('li');
				arr.forEach((element) => {
					li.innerHTML += `<h2 style="display: inline;">${element.number}</h2> &emsp; ${element.step}`;
					ol.appendChild(li);
					li = document.createElement('li');
				});
			}

			function loadRecipeData() {
				var recipe = JSON.parse(localStorage.getItem('<?php echo $id ?>'));

				// document.getElementById("aggregateLikes").innerHTML = recipe.aggregateLikes;
				// document.getElementById("analyzedInstructions").innerHTML = recipe.analyzedInstructions;
				// document.getElementById("cheap").innerHTML = recipe.cheap;
				document.getElementById("cookingMinutes").innerHTML = recipe.cookingMinutes;
				document.getElementById("creditsText").innerHTML = recipe.creditsText;
				// document.getElementById("cuisines").innerHTML = recipe.cuisines;
				document.getElementById("dairyFree").innerHTML = (recipe.dairyFree = "true") ? "Yes" : "No";
				// document.getElementById("diets").innerHTML = recipe.diets;
				// document.getElementById("dishTypes").innerHTML = recipe.dishTypes;
				// document.getElementById("extendedIngredients").innerHTML = recipe.extendedIngredients;
				// document.getElementById("gaps").innerHTML = recipe.gaps;
				document.getElementById("glutenFree").innerHTML = (recipe.glutenFree = "true") ? "Yes" : "No";
				document.getElementById("healthScore").innerHTML = recipe.healthScore;
				// document.getElementById("recipeId").innerHTML = recipe.id;
				document.getElementById("recipeImage").src = recipe.image;
				// document.getElementById("instructions").innerHTML = recipe.instructions;
				document.getElementById("lowFodmap").innerHTML = (recipe.lowFodmap = "true") ? "Yes" : "No";
				// document.getElementById("occasions").innerHTML = recipe.occasions;
				document.getElementById("preparationMinutes").innerHTML = recipe.preparationMinutes;
				document.getElementById("pricePerServing").innerHTML = recipe.pricePerServing;
				document.getElementById("readyInMinutes").innerHTML = recipe.readyInMinutes;
				document.getElementById("servings").innerHTML = recipe.servings;
				// document.getElementById("sourceName").innerHTML = recipe.sourceName;
				document.getElementById("sourceUrl").href = recipe.sourceUrl;
				// document.getElementById("spoonacularSourceUrl").innerHTML = recipe.spoonacularSourceUrl;
				document.getElementById("summary").innerHTML = recipe.summary;
				document.getElementById("recipeTitle").innerHTML = recipe.title;
				document.getElementById("vegan").innerHTML = (recipe.vegan = "true") ? "Yes" : "No";
				document.getElementById("vegetarian").innerHTML = (recipe.vegetarian = "true") ? "Yes" : "No";
				// document.getElementById("veryHealthy").innerHTML = recipe.veryHealthy;
				// document.getElementById("veryPopular").innerHTML = recipe.veryPopular;
				document.getElementById("weightWatcherSmartPoints").innerHTML = recipe.weightWatcherSmartPoints;

				makeBulletList(recipe.extendedIngredients, "ingredientsList");
				makeOrderedList(recipe.analyzedInstructions[0].steps, "directionsList");
			}
		</script>
	</head>
	<body class="is-preload" onload="loadRecipeData()">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						
						<div id="preloader"></div>

						<div class="inner">

							<!-- Header -->
								<header id="header">
								<a href="index.php" class="logo"><strong>MiMeals</strong></a>
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
										<span class="image fit"><img id="recipeImage" alt="" /></span>
										<h1><span id="recipeTitle"></span></h1>
										<div class="row">
											<div class="col-10 col-12-small" style="align-text: left;">
												<h3>In credit to: <span id="creditsText"></span></h3>
											</div>
											<div class="off-10-small col-12-small" style="text-align:right;white-space:nowrap;">
												<a href="#" class="button primary small icon solid fa-heart">69420</a>
											</div>
										</div>
										<!-- <div class="off-9-small col-12-small" style="text-align:right;white-space:nowrap;">
											<a href="#" class="button primary small icon solid fa-heart">69420</a>
										</div> -->
										<!-- 
										
										FOLLOW HOW THIS WEBSITE FORMATS THEIR RECIPES: https://www.foodnetwork.com/recipes/ree-drummond/simple-perfect-chili-recipe-2107099

										INCLUDE AUTHOR AND LIKES

										-->
									</header>
									<!-- Content -->

									<div class="table-wrapper">
										<table>
											<tbody>
												<tr>
													<td><b>Health Score:</b> <span id="healthScore"></span></td>
													<td><b>Weight Watcher Smart Points:</b> <span id="weightWatcherSmartPoints"></span></td>
												</tr>
											</tbody>
										</tfoot>
										</table>
									</div>
									<div class="table-wrapper">
										<table>
											<tbody>
												<tr>
													<td><b>Total Time:</b> <span id="readyInMinutes"></span> minutes</td>
													<td><b>Preparation Time:</b> <span id="preparationMinutes"></span> minutes</td>
													<td><b>Cooking Time:</b> <span id="cookingMinutes"></span> minutes</td>
													<td><b>Servings:</b> <span id="servings"></span></td>
													<td><b>Price Per Serving:</b> $<span id="pricePerServing"></span></td>
												</tr>
											</tfoot>
										</table>
									</div>
									<div class="table-wrapper">
										<table>
											<tbody>
												<tr>
													<td><b>Dairy Free:</b> <span id="dairyFree"></span></td>
													<td><b>Gluten Free:</b> <span id="glutenFree"></span></td>
													<td><b>Vegan:</b> <span id="vegan"></span></td>
													<td><b>Vegetarian:</b> <span id="vegetarian"></span></td>
													<td><b>Low FODMAP:</b> <span id="lowFodmap"></span></td>
												</tr>
											</tfoot>
										</table>
									</div>
									<!-- 
										COLLAPSIBLE MENU FOR NUTRITION INFORMATION

										BREAK

										OPTION TO SAVE, DOWNLOAD, SHARE, NAVIGATE TO, AND PRINT RECIPE
										-->
									<hr>
									<div class="container">
										<a href="#" class="button primary large">Add Recipe</a>
										<a href="#" id="sourceUrl" class="button primary large">Visit Website</a>
										<a href="#" class="button large">Download</a>
										<a href="#" class="button large">Print</a>
										<a href="#" class="button large">Share</a>
									</div>
									<hr>
									<div>
										<p><span id="summary"></span></p>
									</div>
									<hr>
									<div class="row">
										<div class="col-6 col-12-small">
											<!-- INGREDIENTS -->
											<h2>Ingredients</h2>
											<ul id="ingredientsList"></ul>
										</div>
										<div class="col-6 col-12-small">
											<!-- DIRECTIONS -->
											<h2>Directions</h2>
											<ol class="alt" id="directionsList"></ol>
										</div>
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

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php">Homepage</a></li>
										<li><a href="guest-explorer.php">Explore</a></li>
										<li><a href="guest-showcase.php">Showcase Page (delete later)</a></li>
										<li><a href="guest-login.php">Login</a></li>
										<li><a href="guest-signup.php">Sign Up</a></li>
									</ul>
								</nav>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">More</a></li>
									</ul>
								</section>

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
			<script src="assets/js/preloader.js"></script>
	</body>
</html>