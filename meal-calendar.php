<!-- win -->
<?php
// session_start();

// if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
?>






<!DOCTYPE HTML>

<!-- setup css specifically for this page -->

<!--  -->

<!-- https://www.youtube.com/watch?v=Z1BGAivZRlE -->

<!-- https://www.geeksforgeeks.org/design-a-calendar-using-html-and-css/ -->

<!-- https://www.mssqltips.com/sqlservertip/7552/events-calendar-html-sql-server-css/ -->


<!-- http://www.dhtmlgoodies.com/packages/dhtml-suite-for-applications/demos/demo-calendar-1.html -->
<!-- https://stackoverflow.com/questions/2161241/to-display-calendar-using-javascript-and-php -->


<!-- add selectable dates -->
<!-- add data to each day? -->
<!-- allow user to click on each day -->
<!-- highlight planned days (to distinguish between unplanned days) using color -->
<!-- https://www.w3schools.com/howto/howto_css_calendar.asp -->



<!-- https://stackoverflow.com/questions/6841379/is-there-java-hashmap-equivalent-in-php -->

<html>
	<head>
		<title >MiMeals | Homepage</title >
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

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Welcome to Mimeals!</h1>
											<p>Your meal planning website</p>
										</header>
										<p>Welcome to our meal planning app! We're excited to help you take the guesswork out of mealtime and simplify your life. With our app, you can easily plan your meals for the week, create shopping lists, and discover new recipes that fit your dietary needs and preferences. Whether you're a busy professional, a health-conscious individual, or simply looking to save time and money, we've got you covered. Our user-friendly interface and customizable options make it easy for you to create a meal plan that works for you and your family. Get ready to take control of your meals and start enjoying stress-free, delicious meals today!</p>
										<ul class="actions">
											<li><a href="guest-signup.php" class="button big">Get Started</a></li>
										</ul>
									</div>
								</section>
						

							<!-- functionality: add days from prev months, when clicking n that also changes past...? -->
							<!-- functionality: do not allow meals to be planned for dates that already happened -->
				
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

									<div class="popup">
										<a id="close" class="button small">Back</a>
									</div>
								</div>


















							<!-- Calendar -->

							<!--  -->

							<h2 align="center" style="color: orange;">January 2021</h2>
							
							<!-- change this based on javascript or mysql?-->
							<!-- USE PHP TO GENRATE HTML -->
							<!-- use php to find date -->
							
							<!-- Weekday Names -->
							<days class="d1" align = 'center'>
							<day>Sun</day>
							<day>Mon</day>
							<day>Tue</day>
							<day>Wed</day>
							<day>Thu</day>
							<day>Fri</day>
							<day>Sat</day>
							</days>
							<br>

							<days class="d7" align = 'center'>
								

								<!-- is there a more efficient way to do this, like a list? or a for loop statement? -->

								<day>1</day>
								<day>2</day>
								<a href="/2022/10/03"><day class="on">3</day></a>
								<day>4</day>
								<day>5</day>
								<day class="on"><a href="/2022/10/06">6</a></day>
								<day>7</day>
								
								
								<day>30</day>
								<day>31</day>
							</days>
							

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
			<script type="module" src='assets/js/calendar.js'></script>

	</body>
</html>
<?php
// } else {
// 	header("Location: index.php");}
?>
