function getRecipes() {
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/get-recipe.php', 
        'type': 'POST',
        'success': function(res) {
            console.log("SUCCESS");
            res = JSON.parse(res);
            console.log(res);
            const container = document.querySelector('.row');
            for (let i = 0; i < res['recipes'].length; i++) {
                let div = document.createElement('div');
                let recipe = res['recipes'][i];
                let redirect = `./guest-recipe.php?id=${recipe.recipeId}`;
                let html = `<div class="col-6 col-12-small">
                                <a href="${redirect}"><span class="image fit"><img src="${recipe.recipeImage}" alt="" /></span></a>
                                <a href="${redirect}"><span class="image fit"><h2>${recipe.recipeTitle}</h2></a>
                                <ul class="actions fit">
                                    <li><a id="planMeal" data-recipe-id="${recipe.recipeId}" data-recipe-title="${recipe.recipeTitle}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Plan Meal</a></li>
                                </ul>
                                <script>
                                    localStorage.setItem("firstname", "Smith");
                                </script>
                            </div>`
                div.innerHTML = html;
                // localStorage.setItem(recipe.id, JSON.stringify(recipe));
                while (div.children.length > 0) {
                    container.appendChild(div.children[0]);
                }
            }
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}

getRecipes();

const overlay = document.querySelector("#overlay");
overlay.classList.add("inactive");

// Popup functionality
const mealPopup = document.querySelector(".meal-popup");
const calendarPopup = document.querySelector(".calendar-popup");


const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                     && currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}
renderCalendar();

// Plan Meal Buttons - DO ONCE PAGE HAS LOADED
var planMeal = document.querySelectorAll('#planMeal');

planMeal.addEventListener('click', function(){
    try {
        calendarPopup.classList.remove("nofade");
    } catch {
        // do nothing
    } 
    try {
        overlay.classList.remove("inactive");
    } catch {
        // do nothing
    } 
    // set the CSS for the popup and overlay to active and set their layer to front
    overlay.classList.add("active");
    overlay.style.zIndex = "999";
    calendarPopup.classList.add("nofade");
    calendarPopup.style.zIndex = "9999";
})

// Create Meal Button
const createMeal = document.querySelector('#create-meal')
createMeal.addEventListener('click', function(){
    try {
        mealPopup.classList.remove("nofade");
    } catch {
        // do nothing
    } 
    try {
        overlay.classList.remove("inactive");
    } catch {
        // do nothing
    } 
    // set the CSS for the popup and overlay to active and set their layer to front
    overlay.classList.add("active");
    overlay.style.zIndex = "999";
    mealPopup.classList.add("nofade");
    mealPopup.style.zIndex = "9999";
})

// click overlay or back button to exit popup 
overlay.addEventListener('click', function(){
    popupOff();
})
const backButton = document.querySelector("#close");
backButton.addEventListener("click", function() {
    popupOff();
})
function popupOff() {
    // disable the popup by changing css class
    mealPopup.classList.remove("nofade");
    mealPopup.classList.add("fade");
    calendarPopup.classList.remove("nofade");
    calendarPopup.classList.add("fade");
    overlay.classList.remove("active");
    overlay.classList.add("inactive");
}


// get image
const input = document.querySelector("#recipePhoto");
const output = document.querySelector("#imageOutput");
input.addEventListener("change", function() {
  const file = input.files;
  const fileURL = URL.createObjectURL(file[0]);
  console.log(fileURL);
  output.src = fileURL;
});

// const recipeLoad = document.querySelector('row')
// let div = document.createElement('div');
// // stuff
// let html = `<ul class="actions fit">
// <li><a href="#" class="button primary fit icon solid fa-download">Add to Recipes</a></li>
// <li><a href="#" class="button fit icon solid fa-search">Visit Website</a></li>
// </ul>`
// div.innerHTML = html




// back button 
// if the user types SOMETHING in the fields, then before exiting, ask if they are sure they want to discard their progress.

// save button
// const = document.querySelector("#save");
// check if data is valid
// save recipe data

