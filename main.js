// Get references to HTML elements
const navLinks = document.querySelectorAll('nav ul li a');
const bannerBtn = document.querySelector('#banner button');
const recipeBtns = document.querySelectorAll('.recipe button');
const mealPlannerForm = document.querySelector('#meal-planner form');

// Add event listeners
navLinks.forEach(link => link.addEventListener('click', smoothScroll));
bannerBtn.addEventListener('click', smoothScroll);
recipeBtns.forEach(btn => btn.addEventListener('click', viewRecipe));
mealPlannerForm.addEventListener('submit', planMeals);

// Define functions
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
