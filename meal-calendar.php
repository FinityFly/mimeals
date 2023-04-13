<!-- win -->
<?php
// session_start();

// if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
?>

<?php
// } else {
// 	header("Location: index.php");}
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
  /* screensize/ 7? */

  grid-template-columns: repeat(7, 12%);
  grid-template-rows:    repeat(6, 100%);
}
/* https://www.w3schools.com/cssref/sel_firstchild.php */


/* create a bunch of month templates... days.d1 means starts month on sunday, days.d2 is monday etc */

/* acc i dont need this anymore */
days.d1 day:first-child { grid-column: 1; }
days.d2 day:first-child { grid-column: 2; }
days.d3 day:first-child { grid-column: 3; }
days.d4 day:first-child { grid-column: 4; }
days.d5 day:first-child { grid-column: 5; }
days.d6 day:first-child { grid-column: 6; }
days.d7 day:first-child { grid-column: 7; }

</style>



<!-- https://stackoverflow.com/questions/6841379/is-there-java-hashmap-equivalent-in-php -->

<!-- php -->
<?php

$html .= '<div class="box">' . ('ALL CAPS BABY') . '</div>';

// I could do the same for month names lol.
// Set the number of days in each month
$daysInMonth = array(
    '1' => 31,
    '2' => 28,
    '3' => 31,
    '4' => 30,
    '5' => 31,
    '6' => 30,
    '7' => 31,
    '8' => 31,
    '9' => 30,
    '10' => 31,
    '11' => 30,
    '12' => 31
);

$leap_years = array(1996, 2000, 2004, 2008, 2012, 2016, 2020, 2024, 2028, 2032, 2036, 2040, 2044, 2048, 2052, 2056, 2060)
if $display_year in $leap_years{
	$dayInMonth['2'] = 29
}else{
	$dayInMonth['2'] = 28
}
// 1-31
$current_date = date('j');
// year
$todays_year = date('y');
// month
$todays_month = date('m');

$display_year = $todays_year;
$display_month = $todays_month;


// the year loop
// or is it -1
// if  $todays_month = 0{
// 	$display_year -=1
// 	$todays_month = 11

// }
// if  $todays_month = 12{
// 	$display_year ++
// 	$todays_month = 0
// }


// current weekday (use to find first day of month)
// 0 is sunday 6 is saturday
$today_weekday = date('w');
$first_date= ($today_weekday-$current_date%7)%7+9;

// first date is now 1 = sunday, 2 = monday etc 7 =saturday
echo $first_date;


// uh ok i got first date, now what...
// fill this out, using first date.
// $current_month = {};
// if $first_date != 0{

// 	// do like a date - 1 thing
// 	$num_last_month__days = date()

// 	// if date is 6, meaning sunday, then 6-6 = 0
// 	// if date is 0, do none
// 	// if date is 1 do 1
// 	// if date is 4 (out of 6), do 4
// 	$num_last_month__display_days = $first_date
// 	// basically display num_last_month__display_days amount of days from the last month




// }

// $prev_months ={};
// $next_month = {};

// $display_calendar = {};

?>






<html>
	<head>
		<title >MiMeals | Homepage</title >
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
						

							<!-- functionality: add days from prev months, when clicking n that also changes past...? -->
							<!-- functionality: do not allow meals to be planned for dates that already happened -->
				
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
								<day class="on"><a href="/2022/10/03">3</a></day>
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
