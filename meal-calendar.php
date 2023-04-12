<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
?>

<!DOCTYPE HTML>

<!-- setup css specifically for this page -->

<!--  -->


<!-- https://www.geeksforgeeks.org/design-a-calendar-using-html-and-css/ -->

<!-- https://www.mssqltips.com/sqlservertip/7552/events-calendar-html-sql-server-css/ -->


<!-- http://www.dhtmlgoodies.com/packages/dhtml-suite-for-applications/demos/demo-calendar-1.html -->
<!-- https://stackoverflow.com/questions/2161241/to-display-calendar-using-javascript-and-php -->


<!-- add selectable dates -->
<!-- add data to each day? -->
<!-- allow user to click on each day -->
<!-- highlight planned days (to distinguish between unplanned days) using color -->
<!-- https://www.w3schools.com/howto/howto_css_calendar.asp -->
<style>

days 
{
  display: grid;
  grid-template-columns: repeat(7, 120px);
  grid-template-rows:    repeat(6, 90px);
}
days.d1 day:first-child { grid-column: 1; }
days.d2 day:first-child { grid-column: 2; }
days.d3 day:first-child { grid-column: 3; }
days.d4 day:first-child { grid-column: 4; }
days.d5 day:first-child { grid-column: 5; }
days.d6 day:first-child { grid-column: 6; }
days.d7 day:first-child { grid-column: 7; }

</style>










<html>
	<head>
		<title>MiMeals | Homepage</title>
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
						


				
							<!-- Calendar Part -->
								<section>
									<header class="major">
										<h2>Calendar</h2>
									</header>
								</section>


							<!-- Calendar -->

							<!--  -->

							<h2 align="center" style="color: orange;">January 2021</h2>
							
							<!-- change this based on javascript or mysql?-->
							<!-- USE PHP TO GENRATE HTML -->

							<?php
							// determing starting date


							// gives day of month
							echo date("d") ;
							// highlight the date
							
							?>

							<days class="d7">
								<day>1</day>
								<day>2</day>
								<day class="on"><a href="/2022/10/03">3</a></day>
								<day>4</day>
								<day>5</day>
								<day class="on"><a href="/2022/10/06">6</a></day>
								<day>7</day>
								
								
								<day>30</day>
								<day>31</day>
							</days>
							
							<table bgcolor="lightgrey" align="center" cellspacing="21" cellpadding="21">
    
  
							<thead>
								<tr>
									<!-- Here we have applied inline style 
										to make it more attractive-->
									<th>Sun</th>
									<th>Mon</th>
									<th>Tue</th>
									<th>Wed</th>
									<th>Thu</th>
									<th>Fri</th>
									<th>sat</th>
								</tr>
							</thead>
          
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>1</td>
									<td>2</td>
								</tr>
								<tr></tr>
								<tr>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
									<td>8</td>
									<td>9</td>
								</tr>
								<tr>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
									<td>15</td>
									<td>16</td>
								</tr>
								<tr>
									<td>17</td>
									<td>18</td>
									<td>19</td>
									<td>20</td>
									<td>21</td>
									<td>22</td>
									<td>23</td>
								</tr>
								<tr>
									<td>24</td>
									<td>25</td>
									<td>26</td>
									<td>27</td>
									<td>28</td>
									<td>29</td>
									<td>30</td>
								</tr>
								<tr>
									<td>31</td>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
								</tr>
							</tbody>
						</table>

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
} else {
	header("Location: index.php");
}
?>