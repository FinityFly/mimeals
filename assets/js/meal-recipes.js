let confirmMealsButton = document.querySelector('.confirm-meals a');
let numToggles = [];

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
                                    <li><a id="planMeal" data-recipe-id="${recipe.recipeId}" data-recipe-title="${recipe.recipeTitle}" data-recipe-image="${recipe.recipeImage}" class="button primary fit icon solid fa-download">Plan Meal</a></li>
                                </ul>
                            </div>`
                div.innerHTML = html;
                // localStorage.setItem(recipe.id, JSON.stringify(recipe));
                while (div.children.length > 0) {
                    container.appendChild(div.children[0]);
                }
            }
            var planMeal = document.querySelectorAll('#planMeal');
            var recipeId, recipeTitle, recipeImage;
            planMeal.forEach(button => {
                button.addEventListener('click', function(e) {
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
                    recipeId = button.getAttribute("data-recipe-id");
                    recipeTitle = button.getAttribute("data-recipe-title");
                    recipeImage = button.getAttribute("data-recipe-image");
                    // set the CSS for the popup and overlay to active and set their layer to front
                    overlay.classList.add("active");
                    overlay.style.zIndex = "999";
                    calendarPopup.classList.add("nofade");
                    calendarPopup.style.zIndex = "9999";
                })
            });
            const daysTag = document.querySelector(".days"),
            currentDate = document.querySelector(".current-date"),
            prevNextIcon = document.querySelectorAll(".icons span");

            console.log(daysTag);

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
                    // liTag += `<li class="inactive" id = '${lastDateofLastMonth - i + 1}'>${lastDateofLastMonth - i + 1}</li>`;

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

            var dateCircle = document.querySelectorAll(".days li");

            prevNextIcon.forEach(icon => { // getting prev and next icons
                icon.addEventListener("click", () => { // adding click event on both icons
                    // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
                    currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

                    if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                        // creating a new date of current year & month and pass it as date value
                        date = new Date(currYear, currMonth, new Date().getDate());
                        currYear = date.getFullYear(); // updating current year with new date year
                        currMonth = date.getMonth(); // updating current month with new date month
                    } else {
                        date = new Date(); // pass the current date as date value
                    }
                    renderCalendar(); // calling renderCalendar function
                    dateCircle = document.querySelectorAll(".days li");
                    
                    numToggles = [];
                    dateCircle.forEach(day => {
                        day.addEventListener("click", function() {
                            day.classList.toggle('selected');
                            if (day.classList.contains('selected')) {
                                numToggles.push(day.innerHTML);
                            } else {
                                numToggles.splice(numToggles.indexOf(day.innerHTML), 1);
                            }
                            if (numToggles.length > 0) {
                                confirmMealsButton.style.display = "block";
                            } else {
                                confirmMealsButton.style.display = "none";
                            }
                        })
                    })
                });
            });

            // date popup window
            const popup = document.querySelector(".date-popup");

            dateCircle.forEach(day => {
                day.addEventListener("click", function() {
                    day.classList.toggle('selected');
                    if (day.classList.contains('selected')) {
                        numToggles.push(day.innerHTML);
                    } else {
                        numToggles.splice(numToggles.indexOf(day.innerHTML), 1);
                    }
                    if (numToggles.length > 0) {
                        confirmMealsButton.style.display = "block";
                    } else {
                        confirmMealsButton.style.display = "none";
                    }
                })
            })

            confirmMealsButton.addEventListener("click", function() {
                numToggles.forEach(d => {
                    let timestamp = new Date(currYear, currMonth, parseInt(d));
                    console.log(timestamp.valueOf());
                    let data = {'recipeId': recipeId, 'recipeTitle': recipeTitle, 'recipeImage': recipeImage, 'time': timestamp.valueOf()};
                    $.ajax({
                        processData: false,
                        async: true,
                        'url': './includes/plan-meal.php', 
                        'type': 'POST',
                        'dataType': 'json',
                        'data': JSON.stringify(data),
                        'success': function(res) {
                            console.log("SUCCESS");
                            console.log(res);
                            popupOff()
                        },
                        'error': function(res) {
                            console.log("ERROR");
                            console.log(res);
                        }
                    });
                })
            })
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}


getRecipes();

// todo: toggle the sidebar when popup is active

const overlay = document.querySelector("#overlay");
overlay.classList.add("inactive");

// Popup functionality
const mealPopup = document.querySelector(".meal-popup");
const calendarPopup = document.querySelector(".calendar-popup");


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

// Save Meal Button

const saveMeal = document.querySelector('#save-meal');
saveMeal.addEventListener("click", function() {

    const recipeTitle = document.querySelector('#recipeTitle').value;
    if (recipeTitle == '') {
        return;
    }

    const recipeDescription = document.querySelector('#recipeDescription').value;
    if (recipeDescription == '') {
        recipeDescription = 'No description provided';
    }

    // recipe stats 
    const prepTimeDays = parseInt(document.querySelector('#prepTimeDays').value);
    const prepTimeHours = parseInt(document.querySelector('#prepTimeHours').value);
    const prepTimeMins = parseInt(document.querySelector('#prepTimeMins').value);
    
    const cookTimeDays = parseInt(document.querySelector('#cookTimeDays').value);
    const cookTimeHours = parseInt(document.querySelector('#cookTimeHours').value);
    const cookTimeMins = parseInt(document.querySelector('#cookTimeMins').value);

    if (prepTimeDays == 'NaN' && prepTimeHours == 'NaN' && prepTimeMins == 'NaN') {
        let box = document.querySelector('#submit-response');
        let boxText = document.querySelector('#submit-response p');
        box.style.display = 'block'
        boxText.innerHTML = 'Please enter a valid preparation time';
        return;
    }
    if (cookTimeDays == 'NaN' && cookTimeHours == 'NaN' && cookTimeMins == 'NaN') {
        let box = document.querySelector('#submit-response');
        let boxText = document.querySelector('#submit-response p');
        box.style.display = 'block'
        boxText.innerHTML = 'Please enter a valid cooking time';
        return;
    }

    if (prepTimeDays == "NaN") {prepTimeDays = 0}
    if (prepTimeHours == "NaN") {prepTimeHours = 0}
    if (prepTimeMins == "NaN") {prepTimeMins = 0}
    if (cookTimeDays == "NaN") {cookTimeDays = 0}
    if (cookTimeHours == "NaN") {cookTimeHours = 0}
    if (cookTimeMins == "NaN") {cookTimeMins = 0}

    let prepTime = (prepTimeMins + prepTimeHours * 60 + prepTimeDays * 24 * 60).toString();
    let cookTime = (cookTimeMins + cookTimeHours * 60 + cookTimeDays * 24 * 60).toString();
    let totalTime = (prepTime + cookTime).toString();

    const numServings = document.querySelector('#numServings').value;
    if (numServings == 'NaN') {
        return;
    }

    const priceServing = document.querySelector('#priceServing').value;
    if (recipeTitle == 'NaN') {
        return;
    }

    // image
    let imageFiles = document.querySelector("#recipePhoto").files;
    const imageURL = URL.createObjectURL(imageFiles[0]);
    
    
    const ingredients = document.querySelector('#ingredients').value;
    if (recipeTitle == '') {
        return;
    }

    const instructions = document.querySelector('#recipeSteps').value;
    if (instructions == '') {
        return;
    }

    // checkboxes
    const dairyFree = (document.querySelector('#dairyFree').checked) ? '1' : '0';
    const glutenFree = (document.querySelector('#glutenFree').checked) ? '1' : '0';
    const vegan = (document.querySelector('#vegan').checked) ? '1' : '0';
    const vegetarian = (document.querySelector('#vegetarian').checked) ? '1' : '0';
    const lowFODMAP = (document.querySelector('#lowFODMAP').checked) ? '1' : '0';

    var data = {'recipeTitle': recipeTitle, 'recipeDescription': recipeDescription, 'prepTime': prepTime, 'cookTime': cookTime, 'totalTime': totalTime, 'image': imageURL, 'numServings': numServings, 'priceServing': priceServing, 'ingredients': ingredients, 'instructions': instructions, 'dairyFree': dairyFree, 'glutenFree': glutenFree, 'vegan': vegan, 'vegetarian': vegetarian, 'lowFODMAP': lowFODMAP};
    console.log('here is the forms recorded data:', data);

    $.ajax({
        processData: false,
        async: true,
        'url': './includes/upload-recipe.php', 
        'type': 'POST',
        'dataType': 'json',
        'data': JSON.stringify(data),
        'success': function(res) {
            console.log("SUCCESS");
            console.log(res);
            popupOff();
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });

});

async function getRecipes(args, page, numRecipes) {
    let recipes = [];
    if (args.length == 0) {
        // sort by popularity
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*10}&number=${numRecipes}`;
        let data = await fetchResponse(query);
        for (let i = 0; i < data.results.length; i++) {
            recipes.push(await getRecipeData(data.results[i].id));
        }
    } else {
        // do later
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*10}&number=${numRecipes}`;
        let data = await fetchResponse(query);
    }
    return recipes;
}

function getPlanned(date) {
    let data = {'date': date};
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/plan-meal.php', 
        'type': 'POST',
        'dataType': 'json',
        'data': JSON.stringify(data),
        'success': function(res) {
            console.log("SUCCESS");
            console.log(res);
            popupOff()
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}

function loadPlanned(date) {
    let recipes = getPlanned(date);
    for (let i = 0; i < recipes.length; i++) {
        let div = document.createElement('div');
        let recipe = recipes[i];
        let redirect = `./guest-recipe.php?id=${recipe.id}`;
        let description = `${(recipe.cuisines.length > 0) ? recipe.cuisines[0] + ' / ' : ''}${recipe.readyInMinutes} minutes / ${recipe.servings} servings / ~$${recipe.pricePerServing}`;
        let html = `<div class="col-6 col-12-small">
                        <a href="${redirect}"><span class="image fit"><img src="${recipe.image}" alt="" /></span></a>
                        <div class="row">
                            <div class="col-9 col-12-small">
                                <a href="${redirect}"><span class="image fit"><h2>${recipe.title}</h2></a>
                            </div>
                            <div class="off-9-small col-12-small" style="text-align:right;white-space:nowrap;">
                                <a href="#" class="button primary small icon solid fa-heart">${recipe.aggregateLikes}</a>
                            </div>
                        </div>
                        <p>${description}</p>
                        <ul class="actions fit">
                            <li><a id="addRecipe" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Add Recipe</a></li>
                            <li><a href="${recipe.sourceUrl}" class="button fit icon solid fa-search">Visit Website</a></li>
                        </ul>
                        <script>
                            localStorage.setItem("firstname", "Smith");
                        </script>
                    </div>`
        div.innerHTML = html;
        localStorage.setItem(recipe.id, JSON.stringify(recipe));
        while (div.children.length > 0) {
            container.appendChild(div.children[0]);
        }
    }
}