// Get references to HTML elements
const getStartedButton = document.getElementById('get-started-btn');
const navLinks = document.querySelectorAll('nav ul li a');
const recipeBtns = document.querySelectorAll('.recipe button');
const mealPlannerForm = document.querySelector('#meal-planner form');

console.log(getStartedButton);

// Add event listeners
getStartedButton.addEventListener('click', getStarted);
navLinks.forEach(link => link.addEventListener('click', smoothScroll));
mealPlannerForm.addEventListener('submit', planMeals);

// Define functions
function getStarted(event) {
    console.log('You pressed the Get Started button!');
}

function smoothScroll(event) {
  event.preventDefault();
  const target = event.currentTarget.getAttribute('href');
  document.querySelector(target).scrollIntoView({behavior: 'smooth'});
}

function viewRecipe(event) {
  const recipeName = event.currentTarget.parentElement.querySelector('h3').textContent;
  alert(`You clicked the "View Recipe" button for ${recipeName}.`);
}

function planMeals(event) {
  event.preventDefault();
  const selectedWeek = event.currentTarget.elements.week.value;
  alert(`You selected ${selectedWeek} for your meal plan.`);
}
