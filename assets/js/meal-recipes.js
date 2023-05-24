console.log($rows)


const overlay = document.querySelector("#overlay");
overlay.classList.add("inactive");

// Popup functionality
const popup = document.querySelector(".popup");

// Create Meal Button
const createMeal = document.querySelector('#create-meal')
createMeal.addEventListener('click',function(){
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
    // set the CSS for the popup and overlay to active and set their layer to front
    overlay.classList.add("active");
    overlay.style.zIndex = "999";
    popup.classList.add("nofade");
    popup.style.zIndex = "9999";
})

// click overlay or back button to exit popup 
overlay.addEventListener('click', function(){
    popupOff();
})
const backButton = document.querySelector("#close");
backButton.addEventListener("click", function() {
    popupOff();
})
function popupOff(){
    // disable the popup by changing css class
    popup.classList.remove("nofade");
    popup.classList.add("fade");
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

