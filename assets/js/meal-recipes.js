let confirmMealsButton = document.querySelector('.confirm-meals a');
let numToggles = [];

let apiRecipes = [];
let customRecipes = [];

function getAPIRecipes() {
    /**
     * Gets the user's saved Spoonacular recipes
   */
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/get-recipe.php', 
        'type': 'POST',
        'success': function(res) {
            console.log("SUCCESS");
            res = JSON.parse(res);
            console.log(res);
            apiRecipes = res['recipes'];
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}

var date, currYear, currMonth;

function displayRecipes() {
    /**
     * Display the user's saved recipes
   */
    const container = document.querySelector('#recipes');

    // display any of the user's saved Spoonacular recipes
    if (apiRecipes != null) {
        for (let i = 0; i < apiRecipes.length; i++) {
            let div = document.createElement('div');
            let recipe = apiRecipes[i];
            let redirect = `./guest-recipe.php?id=${recipe.recipeId}`;
            let html = `<div class="col-6 col-12-small">
                            <a href="${redirect}"><span class="image fit"><img src="${recipe.recipeImage}" alt="" /></span></a>
                            <a href="${redirect}"><span class="image fit"><h2>${recipe.recipeTitle}</h2></a>
                            <ul class="actions fit">
                                <li style="padding: 10px;"><a id="planMeal" data-recipe-id="${recipe.recipeId}" data-recipe-title="${recipe.recipeTitle}" data-recipe-image="${recipe.recipeImage}" class="button primary fit icon solid fa-download">Plan Meal</a></li>
                                <li style="padding: 10px;"><a id="removeMeal" data-recipe-id="${recipe.recipeId}" class="button fit icon solid fa-ban">Remove Meal</a></li>
                            </ul>
                        </div>`
            div.innerHTML = html;
            // localStorage.setItem(recipe.id, JSON.stringify(recipe));
            while (div.children.length > 0) {
                container.appendChild(div.children[0]);
            }
        }
    }
    // display any of the user's custom-made recipes
    if (customRecipes != null) {
        for (let i = 0; i < customRecipes.length; i++) {
            let div = document.createElement('div');
            let recipe = customRecipes[i];
            let redirect = `./guest-recipe.php?id=${recipe.id}`;
            let html = `<div class="col-6 col-12-small">
                            <a href="${redirect}"><span class="image fit"><img src="${recipe.image}" alt="" /></span></a>
                            <a href="${redirect}"><span class="image fit"><h2>${recipe.recipeTitle}</h2></a>
                            <ul class="actions fit">
                                <li style="padding: 10px;"><a id="planMeal" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.recipeTitle}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Plan Meal</a></li>
                                <li style="padding: 10px;"><a id="removeCustomMeal" data-recipe-id="${recipe.id}" class="button fit icon solid fa-ban">Remove Meal</a></li>
                            </ul>
                        </div>`
            div.innerHTML = html;
            // localStorage.setItem(recipe.id, JSON.stringify(recipe));
            while (div.children.length > 0) {
                container.appendChild(div.children[0]);
            }
        }
    }

    // For each meal, add a button which will let the user add the meal to their calendar
    var planMeal = document.querySelectorAll('#planMeal');
    console.log(planMeal);
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

            renderCalendar();

            calendarPopup.classList.add("nofade");
            calendarPopup.style.zIndex = "9999";

            getPlanned(recipeId);
        })
    });

    // Calendar
    const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span");

    date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth(); // getting new date, current year and month

    const months = ["January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"]; // storing full name of all months in array

    const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
        
        // Create list of tags for each day of a month
        let liTag = "";
        // creating li of previous month last days
        for (let i = firstDayofMonth; i > 0; i--) { 
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }
        // creating li of all days of current month
        for (let i = 1; i <= lastDateofMonth; i++) { 
            // adding active class to li if the current day, month, and year matched
            let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                        && currYear === new Date().getFullYear() ? "active" : "";
            liTag += `<li class="${isToday}">${i}</li>`;
        }
        // creating li of next month first days
        for (let i = lastDayofMonth; i < 6; i++) { 
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
        }
        currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
        daysTag.innerHTML = liTag;
        
        var dateCircle = document.querySelectorAll(".days li");

        // Functionality to select previous and next month from calendar
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

                // highlighting selected dates to add to planned recipes
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
        // const popup = document.querySelector(".date-popup");

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
    }
    renderCalendar();

    // Confirm button to update database with selected dates for a given planned recipe
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

    // button to remove Spoonacular meal from user's saved recipes
    const deleteRecipeButton = document.querySelectorAll('#removeMeal');
    deleteRecipeButton.forEach(btn => {
        btn.addEventListener('click', function() {
            let rId = btn.getAttribute("data-recipe-id");
            var data = {'recipeId': rId};
            $.ajax({
                processData: false,
                async: true,
                'url': './includes/delete-recipe.php', 
                'type': 'POST',
                'dataType': 'json',
                'data': JSON.stringify(data),
                'success': function(res) {
                    console.log("SUCCESS");
                    console.log(res);
                    if (res.deleted) {
                        btn.innerHTML = "Recipe deleted!";
                    } else {
                        btn.innerHTML = "Error, try again";
                    }
                },
                'error': function(res) {
                    console.log("ERROR");
                    console.log(res);
                    btn.innerHTML = "Error, try again";
                }
            });
        })
    })

    // button to remove user's custom meal from user's saved recipes
    const deleteCustomRecipeButton = document.querySelectorAll('#removeCustomMeal');
    deleteCustomRecipeButton.forEach(btn => {
        btn.addEventListener('click', function() {
            let rId = btn.getAttribute("data-recipe-id");
            var data = {'recipeId': rId};
            $.ajax({
                processData: false,
                async: true,
                'url': './includes/delete-custom-recipe.php', 
                'type': 'POST',
                'dataType': 'json',
                'data': JSON.stringify(data),
                'success': function(res) {
                    console.log("SUCCESS");
                    console.log(res);
                    if (res.deleted) {
                        btn.innerHTML = "Recipe deleted!";
                    } else {
                        btn.innerHTML = "Error, try again";
                    }
                },
                'error': function(res) {
                    console.log("ERROR");
                    console.log(res);
                    btn.innerHTML = "Error, try again";
                }
            });
        })
    })
}

function getCustomRecipes() {
    /**
     * Gets the user's saved custom recipes
   */
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/get-custom-recipe.php', 
        'type': 'POST',
        'success': function(res) {
            console.log("SUCCESS");
            res = JSON.parse(res);
            console.log(res);
            customRecipes = res['recipes'];
            displayRecipes();
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}



getAPIRecipes();
getCustomRecipes();

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


// get image input and display it
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

    // Collect recipe data

    // Recipe Title
    const recipeTitle = document.querySelector('#recipeTitle').value;
    if (recipeTitle == '') {
        return;
    }
    // Recipe Description
    const recipeDescription = document.querySelector('#recipeDescription').value;
    if (recipeDescription == '') {
        recipeDescription = 'No description provided';
    }

    // Recipe numerical statistics
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

    // Recipe image
    let imageFiles = document.querySelector("#recipePhoto").files;
    const imageURL = URL.createObjectURL(imageFiles[0]);
    
    // Recipe ingredients
    const ingredients = document.querySelector('#ingredients').value;
    if (recipeTitle == '') {
        return;
    }
    // Recipe steps
    const instructions = document.querySelector('#recipeSteps').value;
    if (instructions == '') {
        return;
    }

    // Diet checkboxes
    const dairyFree = (document.querySelector('#dairyFree').checked) ? '1' : '0';
    const glutenFree = (document.querySelector('#glutenFree').checked) ? '1' : '0';
    const vegan = (document.querySelector('#vegan').checked) ? '1' : '0';
    const vegetarian = (document.querySelector('#vegetarian').checked) ? '1' : '0';
    const lowFODMAP = (document.querySelector('#lowFODMAP').checked) ? '1' : '0';

    var data = {'recipeTitle': recipeTitle, 'recipeDescription': recipeDescription, 'prepTime': prepTime, 'cookTime': cookTime, 'totalTime': totalTime, 'image': imageURL, 'numServings': numServings, 'priceServing': priceServing, 'ingredients': ingredients, 'instructions': instructions, 'dairyFree': dairyFree, 'glutenFree': glutenFree, 'vegan': vegan, 'vegetarian': vegetarian, 'lowFODMAP': lowFODMAP};
    console.log('here is the forms recorded data:', data);

    // send the data to php file, where it will be uploaded to the database
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

    // display recipe
    let div = document.createElement('div');
    // get the recipe
    let recipe = data;
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
                </div>`
    div.innerHTML = html;
    localStorage.setItem(recipe.id, JSON.stringify(recipe));
    container.appendChild(div.children[0]);
});

function getPlanned(recipeId) {
    /**
     * Display recipe info for the scrolling menu
     * @param  {int} recipeId the Spoonacular identifcation number, unique to every recipe   
   */
    let data = {'recipeId': recipeId};
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/get-planned-recipe.php', 
        'type': 'POST',
        'dataType': 'json',
        'data': JSON.stringify(data),
        'success': function(res) {
            console.log("SUCCESS");
            console.log(res);
            if (res['empty'] == false) {
                const calendar = document.querySelectorAll('.days li');
                res['recipes'].forEach(meal => {
                    let d = new Date(parseInt(meal['time']));
                    if (d.getMonth() == currMonth) {
                        calendar.forEach(day => {
                            if (d.getDate().toString() == day.innerHTML && !day.classList.contains("inactive")) {
                                console.log(day);
                                day.classList.add('planned');
                            }
                        })
                    }
                })
            }
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}