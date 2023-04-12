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
			function loadRecipeData() {
				var recipe = JSON.parse(localStorage.getItem('<?php echo $id ?>'));
				// document.getElementById("aggregateLikes").innerHTML = recipe.aggregateLikes;
				// document.getElementById("analyzedInstructions").innerHTML = recipe.analyzedInstructions;
				// document.getElementById("cheap").innerHTML = recipe.cheap;
				// document.getElementById("cookingMinutes").innerHTML = recipe.cookingMinutes;
				// document.getElementById("creditsText").innerHTML = recipe.creditsText;
				// document.getElementById("cuisines").innerHTML = recipe.cuisines;
				// document.getElementById("dairyFree").innerHTML = recipe.dairyFree;
				// document.getElementById("diets").innerHTML = recipe.diets;
				// document.getElementById("dishTypes").innerHTML = recipe.dishTypes;
				// document.getElementById("extendedIngredients").innerHTML = recipe.extendedIngredients;
				// document.getElementById("gaps").innerHTML = recipe.gaps;
				// document.getElementById("glutenFree").innerHTML = recipe.glutenFree;
				// document.getElementById("healthScore").innerHTML = recipe.healthScore;
				// document.getElementById("recipeId").innerHTML = recipe.id;
				document.getElementById("recipeImage").src = recipe.image;
				// document.getElementById("instructions").innerHTML = recipe.instructions;
				// document.getElementById("lowFodmap").innerHTML = recipe.lowFodmap;
				// document.getElementById("occasions").innerHTML = recipe.occasions;
				// document.getElementById("preparationMinutes").innerHTML = recipe.preparationMinutes;
				// document.getElementById("pricePerServing").innerHTML = recipe.pricePerServing;
				// document.getElementById("readyInMinutes").innerHTML = recipe.readyInMinutes;
				// document.getElementById("servings").innerHTML = recipe.servings;
				// document.getElementById("sourceName").innerHTML = recipe.sourceName;
				// document.getElementById("sourceUrl").innerHTML = recipe.sourceUrl;
				// document.getElementById("spoonacularSourceUrl").innerHTML = recipe.spoonacularSourceUrl;
				// document.getElementById("summary").innerHTML = recipe.summary;
				document.getElementById("recipeTitle").innerHTML = recipe.title;
				// document.getElementById("vegan").innerHTML = recipe.vegan;
				// document.getElementById("vegetarian").innerHTML = recipe.vegetarian;
				// document.getElementById("veryHealthy").innerHTML = recipe.veryHealthy;
				// document.getElementById("veryPopular").innerHTML = recipe.veryPopular;
				// document.getElementById("weightWatcherSmartPoints").innerHTML = recipe.weightWatcherSmartPoints;
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
										<div>
											<a href="#"><span class="image fit"><img id="recipeImage" alt="" /></span></a>
										</div>
										<h1><span id="recipeTitle"></span></h1>
										<!-- 
										
										FOLLOW HOW THIS WEBSITE FORMATS THEIR RECIPES: https://www.foodnetwork.com/recipes/ree-drummond/simple-perfect-chili-recipe-2107099

										INCLUDE AUTHOR AND LIKES

										 -->
									</header>
									<!-- Content -->

										<!-- 
										
										-TIME
											-readyInMinutes, preparationMinutes, cookingMinutes
										-PRICE
											-servings, pricePerServing
										-DIET
											-dairyFree, glutenFree, vegan, vegetarian, lowFodmap
										-NUTRITION
											-veryPopular, veryHealthy, healthScore, weightWatcherSmartPoints

										 -->


										<div>
											<p>Introducing our recipe explorer - the ultimate tool for culinary exploration. With just a simple scroll, you can discover a vast array of recipes from every corner of the world, each one guaranteed to excite your taste buds and inspire your creativity in the kitchen. From the bold flavors of Latin American cuisine to the aromatic spices of Indian dishes, our recipe explorer allows you to take a global journey from the comfort of your own home.</p>
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
			<script src="assets/js/recipe.js"></script>
	</body>
</html>