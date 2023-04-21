
// Popup functionality

// get image
const input = document.querySelector("#recipePhoto")
const output = document.querySelector("output")
let imagesArray = []
input.addEventListener("change", function() {
  const file = input.files
  imagesArray.push(file[0])
  let images = ""
  imagesArray.forEach((image, index) => {
    images += `<div class="image">
                <img src="${URL.createObjectURL(image)}" alt="image">
              </div>`
})
output.innerHTML = images
}




// back button 
// if the user types SOMETHING in the fields, then before exiting, ask if they are dsure htey want to discard their progress.

// save button
// const = document.querySelector("#save");
// check if data is valid

// we need:


// save recipe data

