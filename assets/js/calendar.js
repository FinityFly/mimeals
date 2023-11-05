var plannedRecipes = {};

function getPlannedRecipes() {
    /**
     * Retrieves the user's planned recipes from the database 
   */
    $.ajax({
        processData: false, 
        async: true,
        'url': './includes/get-planned.php', 
        'type': 'POST',
        'success': function(res) {
            console.log("SUCCESS");
            res = JSON.parse(res);
            const calendar = document.querySelectorAll('.days li');
            if (res['recipes'] != null) {
                res['recipes'].forEach(meal => {
                    
                    // create a date for the meal's time
                    let mealTime = parseInt(meal['time']);

                    // if it isn't already in the planned recipes list, create a sub-hashmap
                    if (!(mealTime in plannedRecipes)) {
                        plannedRecipes[mealTime] = [];
                    }
                    // add the recipe to the date in the planned recipes list
                    plannedRecipes[mealTime].push(meal);

                    // display active planned days on calendar
                    let d = new Date(mealTime);
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
            return;
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
        }
    });
}

getPlannedRecipes();

// for the blurry background overlay when opening a popup
const overlay = document.querySelector("#overlay");
overlay.classList.add("inactive");

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
    
    // Create list of tags for each day of a month
    let liTag = "";
    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive" >${lastDateofLastMonth - i + 1}</li>`;
        
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
clickDate();

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
        clickDate();

        
    });
});


function clickDate(){
    /**
     * When clicking on a date:
     *      Turn on a blurry background to accentuate the popup
     *      Output its date
     *      Show any recipes planned to this date
     *      Add a remove meal funcitonality to any displayed meals
   */
    var dateCircle = document.querySelectorAll(".days li");
    dateCircle = document.querySelectorAll(".days li");
    dateCircle.forEach(day => {
        day.addEventListener("click", function(e) {
            console.log("clicked");

            // blurry bg
            try{
                popup.classList.remove("nofade");
            }
            catch{
                // do nothing
            } 
            try{
                overlay.classList.remove("inactive");
            }
            catch{
                // do nothing
            } 
    
            let recipeList = document.querySelector('.recipe-list');
            recipeList.replaceChildren();
    
            // set the CSS for the popup and overlay to active and set their layer to front
            overlay.classList.add("active");
            overlay.style.zIndex = "999";
    
            popup.classList.add("nofade");
            popup.style.zIndex = "9999";
    
            // Output the date 
            let d;
            if (day.classList.contains("inactive")) {
                if (parseInt(day.innerHTML) >= 26) {
                    if (currMonth == 0) {
                        d = new Date(currYear-1, 11, parseInt(day.innerHTML));
                    } else {
                        d = new Date(currYear, currMonth-1, parseInt(day.innerHTML));
                    }
                } else if (parseInt(day.innerHTML) <= 6) {
                    if (currMonth == 11) {
                        d = new Date(currYear+1, 0, parseInt(day.innerHTML));
                    } else {
                        d = new Date(currYear, currMonth+1, parseInt(day.innerHTML));
                    }
                }
            } else {
                d = new Date(currYear, currMonth, parseInt(day.innerHTML));
            }
            let dateString = `Your meals for ${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
            document.querySelector("#datestring").innerHTML = dateString;

            // Display recipe info
            const container = document.querySelector('.recipe-list');
            if (d.getTime() in plannedRecipes) {
                for (let i = 0; i < plannedRecipes[d.getTime()].length; i++) {
                    let div = document.createElement('div');
                    let recipe = plannedRecipes[d.getTime()][i];
                    console.log(recipe);
                    let redirect = `./guest-recipe.php?id=${recipe.recipeId}`;
                    let html = `<div class="box" style="display: flex; padding: 10px; margin: 10px;">
                                    <div style="padding: 10px;">
                                        <a href="${redirect}"><span class="image fit"><img src="${recipe.recipeImage}" alt="" /></span></a>
                                    </div>
                                    <div style="width: 50%; padding: 10px;">
                                        <a href="${redirect}"><p style="font-size: 36px";>${recipe.recipeTitle}</p></a>
                                    </div>
                                    <div style="width: 50%; padding: 10px;">
                                        <ul class="actions fit" style="display: inline-block; font-size: 26px;">
                                            <li style="padding: 10px; top: 50%;"><a href="${redirect}" class="button primary fit small icon solid fa-eye">View Recipe</a></li>
                                            <li style="padding: 10px;"><a href="${recipe.recipeImage}" class="button fit small icon solid fa-search">Visit Website</a></li>
                                            <li style="padding: 10px;"><a id="removeMeal" data-recipe-id="${recipe.recipeId}" class="button fit small icon solid fa-ban">Remove Meal</a></li>
                                        </ul>
                                    </div>
                                </div>`
                    div.innerHTML = html;
                    localStorage.setItem(recipe.id, JSON.stringify(recipe));
                    while (div.children.length > 0) {
                        container.appendChild(div.children[0]);
                    }
                }

                // Remove meal buttons
                const removeMealButton = document.querySelectorAll('#removeMeal');
                removeMealButton.forEach(btn => {
                    btn.addEventListener('click', function() {
                        let rId = btn.getAttribute("data-recipe-id");
                        var data = {'recipeId': rId, 'time': d.getTime().toString()};
                        console.log(d.getTime());
                        $.ajax({
                            processData: false,
                            async: true,
                            'url': './includes/delete-planned.php', 
                            'type': 'POST',
                            'dataType': 'json',
                            'data': JSON.stringify(data),
                            'success': function(res) {
                                console.log("SUCCESS");
                                console.log(res);
                                if (res.deleted) {
                                    btn.innerHTML = "Meal unplanned!";
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
    
    
        })
    })
}



// overlay exit popup functionality
overlay.addEventListener('click', function(){
    popupOff();
})

// back button functionality
const backButton = document.querySelector("#close");
backButton.addEventListener("click", function() {
    popupOff();
})

const popup = document.querySelector(".date-popup");
function popupOff(){
    // remove the 'active' css style 
    popup.classList.remove("nofade");
    popup.classList.add("fade");
    overlay.classList.remove("active");
    overlay.classList.add("inactive");
}
