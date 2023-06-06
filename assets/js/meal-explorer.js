import Recipe from './recipeObj.js';

const container = document.querySelector('#allResults');
const searchResults = document.querySelector('#searchResults');
const pageContainer = document.querySelector('.pagination');

let apiKey = "dc09bd6aec87426f9b4a4c30ddaf204f"; // put into dotenv later
let apiKey2 = "3f043de69de544e6b333d34d97e988c7";
let apiKey3 = '4621a74d2ad64a26adee0016e0be6c53';
let apiKey4 ='cbcf41d0632a4583b2cbbe3c44a434ae';
let apiKey5 = 'a8c6d5e81bd44739b69f8400661a6b38';
let apiKey6 = '1fcc4a609e8643ab8595fc540fd2e6a9';
apiKey = apiKey5;
let numRecipesLoaded = 2;
let pagesLoaded= 0;

async function fetchResponse(query) {
    let response = await fetch(query);
    let data = await response.json();
    return data;
}

async function searchRecipes(query){
    let searchQuery = `https://api.spoonacular.com/food/search?query=${query}&apiKey=${apiKey}`;
    let data = await fetchResponse(searchQuery);
    // console.log(data.searchResults[0].results);
    let recipes = [];
    for (let i = 0; i < data.searchResults[0].results.length; i++) {
        recipes.push(await getRecipeData(data.searchResults[0].results[i].id));
    }
    return recipes;

}

// get the recipe 
async function getRecipeData(id) {
    let query = `https://api.spoonacular.com/recipes/${id}/information?apiKey=${apiKey}`;
    let data = await fetchResponse(query);
    let recipe = new Recipe(data.aggregateLikes, data.analyzedInstructions, data.cheap, data.cookingMinutes, data.creditsText, data.cuisines, data.dairyFree, data.diets, data.dishTypes, data.extendedIngredients, data.gaps, data.glutenFree, data.healthScore, data.id, data.image, data.instructions, data.lowFodmap, data.occasions, data.preparationMinutes, data.pricePerServing, data.readyInMinutes, data.servings, data.sourceName, data.sourceUrl, data.spoonacularSourceUrl, data.summary, data.title, data.vegan, data.vegetarian, data.veryHealthy, data.veryPopular, data.weightWatcherSmartPoints);
    return recipe;
}

async function getRecipes(args, page, numRecipes) {
    let recipes = [];
    if (args.length == 0) {
        // sort by popularity
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*numRecipesLoaded}&number=${numRecipes}`;
        let data = await fetchResponse(query);
        for (let i = 0; i < data.results.length; i++) {
            recipes.push(await getRecipeData(data.results[i].id));
        }
    } else {
        // do later
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*numRecipesLoaded}&number=${numRecipes}`;
        let data = await fetchResponse(query);
    }
    return recipes;
}


// generating a search from an input
const searchMeal = document.querySelector('#search-meal');
searchMeal.addEventListener("click", async function() {
    const search = document.querySelector("#search").value;
    
        let recipes = await searchRecipes(search);
        
        let reps;
        if (recipes.length < 2) {
            reps = recipes.length;
        } else {
            reps = 2;
        }


        for (let i = 0; i < reps; i++) {
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
                        </div>`
            div.innerHTML = html;
            localStorage.setItem(recipe.id, JSON.stringify(recipe));
            while (div.children.length > 0) {
                searchResults.appendChild(div.children[0]);
            }
        }
        const addRecipeButtons = document.querySelectorAll('#addRecipe');
        addRecipeButtons.forEach(button => {
            
            let recipeId = button.getAttribute("data-recipe-id");
            let recipeTitle = button.getAttribute("data-recipe-title");
            let recipeImage = button.getAttribute("data-recipe-image");
            console.log(recipeId);
            button.addEventListener("click", function() {
                addRecipe(recipeId, recipeTitle, recipeImage);
            });
        });

    
});


// Update an HTML 'row' container to display recipe info
async function loadRecipes(n, page = 0) {
    let recipes = await getRecipes([], page, n);
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
                            <li><a href="${redirect}" class="button primary fit icon solid fa-eye">View Recipe</a></li>
                            <li><a id="addRecipe" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Add Recipe</a></li>
                            <li><a href="${recipe.sourceUrl}" class="button fit icon solid fa-search">Visit Website</a></li>
                        </ul>
                    </div>`
        div.innerHTML = html;
        localStorage.setItem(recipe.id, JSON.stringify(recipe));
        while (div.children.length > 0) {
            container.appendChild(div.children[0]);
        }
        
        


    }
    const addRecipeButtons = document.querySelectorAll('#addRecipe');
        addRecipeButtons.forEach(button => {
            
            let recipeId = button.getAttribute("data-recipe-id");
            let recipeTitle = button.getAttribute("data-recipe-title");
            let recipeImage = button.getAttribute("data-recipe-image");
            console.log(recipeId);
            button.addEventListener("click", function() {
                addRecipe(recipeId, recipeTitle, recipeImage);
            });
        });
}


// When any recipe's "add Recipe" buttons is clicked, 
// pass the recipe's Id, Title, and Image to the addRecipe function, 
// where it will be added to the user's saved meals database.



function addRecipe(id, title, image) {
    var data = {'recipeId': id, 'recipeTitle': title, 'recipeImage': image};
    var recipeButton = document.querySelector(`[data-recipe-id="${id}"]`);
    
    // send the data to add-recipe.php, where the recipe will be added to
    // the user's database of saved meals
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/add-recipe.php', 
        'type': 'POST',
        'dataType': 'json',
        'data': JSON.stringify(data),
        'success': function(res) {
            console.log("SUCCESS");
            console.log(res);
            
            // Upon a successful data transmission, update the button 
            // visual to notify the user that their meal has been saved
            if (res.status) {
                if (res.added) {
                    recipeButton.innerHTML = "Recipe added!";
                } else {
                    recipeButton.innerHTML = "Already added";
                }
            }
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
            recipeButton.innerHTML = "Error";
        }
    });
};
// let div = document.createElement('div');
const loadMoreButton = document.querySelector(`#loadMore`);
loadMoreButton.addEventListener("click", () => {
    loadRecipes(numRecipesLoaded, pagesLoaded+numRecipesLoaded);
    pagesLoaded+=2;
})



// // here, n is the beginning number. There will be 10 pages loaded at a time
// function loadPages(n){
    
//     n = parseInt(n);

    
    
//     let html = `<li><span class="button" id = prevPage>Prev</span></li>`
//     div.innerHTML = html;
//     pageContainer.appendChild(div.children[0]);

//     for (let i = -2; i < 3; i++) {
//         // html = `<li class="pagination page" id ='${3+n+i}'>${3+n+i}</li>`
//         if (i==-2){
//             html = `<li class="pagination page" id ='${3+n+i}'>${3+n+i}</li>`
//             // html = `<li><a href="#" class="pagination page active" id ='${3+n+i}'>${3+n+i}</a></li>`
//         }else{
//             html = `<li class="pagination page" id ='${3+n+i}'>${3+n+i}</li>`
//             // html = `<li><a href="#" class="pagination page" id ='${3+n+i}'>${3+n+i}</a></li>`
//         }
        
        
//         div.innerHTML = html;
//         pageContainer.appendChild(div.children[0]);
        
//     }
    
//     let next = `<li><span class="button" id = nextPage>Next</span></li>`
//     div.innerHTML = next;
//     pageContainer.appendChild(div.children[0]);

//     const prevPage = document.querySelector(`#prevPage`);
//     prevPage.addEventListener("click", () => {
//         if (n>0){
//             clearPages()
//             loadPages(n-1);
//             loadRecipes(numRecipesLoaded+1, n-1);
//         }
//     })

//     const pageButtons = document.querySelectorAll('.page');
//     pageButtons.forEach(button => {
//     button.addEventListener("click", function() {

//         clearPages()
//         loadPages(button.id-1);
//         loadRecipes(numRecipesLoaded+1, button.id);
//     });

//     const nextPage = document.querySelector(`#nextPage`);
//     nextPage.addEventListener("click", () => {
//         clearPages()
//         loadPages(n+1);
//         loadRecipes(numRecipesLoaded, n+1);
//     })
//     console.log(div.children.length);

// });

    
// }


// function clearPages(){
//     // https://stackoverflow.com/questions/3955229/remove-all-child-elements-of-a-dom-node-in-javascript
//     while (pageContainer.firstChild) {
//         pageContainer.removeChild(pageContainer.lastChild);
//     }
// }

// loadPages(0);   
loadRecipes(numRecipesLoaded, 0);
