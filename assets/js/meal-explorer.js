import Recipe from './recipeObj.js';

var Application = {'loading': false};
const container = document.querySelector('#allResults');
const searchResults = document.querySelector('#searchResults');
// const pageContainer = document.querySelector('.pagination');


// several API keys from several emails because there is a daily limit to API calls
let apiKey = "dc09bd6aec87426f9b4a4c30ddaf204f"; 
let apiKey2 = "3f043de69de544e6b333d34d97e988c7";
let apiKey3 = '4621a74d2ad64a26adee0016e0be6c53';
let apiKey4 ='cbcf41d0632a4583b2cbbe3c44a434ae';
let apiKey5 = 'a8c6d5e81bd44739b69f8400661a6b38';
let apiKey6 = '1fcc4a609e8643ab8595fc540fd2e6a9';
apiKey = apiKey ;

// set the default number of recipes loaded for the search (numRecipesLoaded) and scroll (numRecipesLoaded_search)

// number of recipes to load each time
let numRecipesLoaded = 2, numRecipesLoaded_search = 4;
// initial number of recipes for scroll menu
let initialNumRecipes = 1;
let pagesLoaded = 0, pagesLoaded_s = 0;

const loader = document.getElementById("preloader");
const loadMoreSearchButton = document.querySelector(`#loadMoreSearch`);

async function fetchResponse(query) {
    /**
     * retrieves data from a URL and returns it in JSON format
     * @param  {String} query  a URL to get data from
   */
    let response = await fetch(query);
    let data = await response.json();
    return data;
}

async function searchRecipes(pageOffset, numRecipesToLoad, query){
    /**
     * Retrieves an inputted # recipes from the Spoonacular recipe database taht match a user's input query, then returns a list of recipe objects 
     * @param  {int} pageOffset  multiplied by the number of recipes loaded each time, this gives the recipe offset
     * @param  {int} numRecipes  number of recipes to load
     * @param  {String} query  user's input for their recommended meal
   */

    // page is the number of refreshes, so page*numRecipesLoaded is the 
    let searchQuery = `https://api.spoonacular.com/food/search?query=${query}&apiKey=${apiKey}&offset=${pageOffset*numRecipesToLoad}&number=${numRecipesToLoad}`;
    let data = await fetchResponse(searchQuery);
    console.log(data.searchResults[0].results);

    // put all fetched recipes in a list
    let recipes = [];
    for (let i = 0; i < data.searchResults[0].results.length; i++) {
        recipes.push(await getRecipeData(data.searchResults[0].results[i].id));
    }
    return recipes;

}

// get a recipe's data
async function getRecipeData(id) {
    /**
     * retrieves rthe recipe data of a givem recipe
     * @param  {int} id the Spoonacular identifcation number, unique to every recipe 
   */
    let query = `https://api.spoonacular.com/recipes/${id}/information?apiKey=${apiKey}`;
    let data = await fetchResponse(query);
    let recipe = new Recipe(data.aggregateLikes, data.analyzedInstructions, data.cheap, data.cookingMinutes, data.creditsText, data.cuisines, data.dairyFree, data.diets, data.dishTypes, data.extendedIngredients, data.gaps, data.glutenFree, data.healthScore, data.id, data.image, data.instructions, data.lowFodmap, data.occasions, data.preparationMinutes, data.pricePerServing, data.readyInMinutes, data.servings, data.sourceName, data.sourceUrl, data.spoonacularSourceUrl, data.summary, data.title, data.vegan, data.vegetarian, data.veryHealthy, data.veryPopular, data.weightWatcherSmartPoints);
    return recipe;
}

async function getRecipes(args, page, numRecipes) {
    /**
     * retrieves recipes from the Spoonacular recipe database, given a user's input query
     * @param  {list} args  for sorting recipes by diet options (not yet  in use)
     * @param  {int} page  multiplied by the number of recipes loaded each time, this gives the offset
     * @param  {String} numRecipes  number of recipes to load
   */
    let recipes = [];
    if (args.length == 0) {
        // sort by popularity
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*numRecipesLoaded}&number=${numRecipes}`;
        let data = await fetchResponse(query);
        for (let i = 0; i < data.results.length; i++) {
            recipes.push(await getRecipeData(data.results[i].id));
        }
    } else {
        // do later, when we implement sorting
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*numRecipesLoaded}&number=${numRecipes}`;
        let data = await fetchResponse(query);
    }
    return recipes;
}


// Displaying Searched Recipes
const searchMeal = document.querySelector('#search-meal');
var searchValue, prevSearchValue;
searchMeal.addEventListener("click", async function() {

    loader.style.display = "block";
    searchValue = document.querySelector("#search").value;

    // there's probably a better way of writing the next 15ish lines

    if (prevSearchValue != searchValue && prevSearchValue != null) {
        // searchResults.replaceChildren;
        while (searchResults.firstChild) {
            searchResults.removeChild(searchResults.lastChild);
        }
        console.log('more!');  
        numRecipesLoaded_search = 4;
        pagesLoaded_s = 0;
    }
    if (prevSearchValue == searchValue && prevSearchValue != null) {
        while (searchResults.firstChild) {
            searchResults.removeChild(searchResults.lastChild);
        }
        console.log('redo!');  
        numRecipesLoaded_search = 4;
        pagesLoaded_s = 0;
    }
    

    // Display the recipes
    await loadSearchedRecipes(numRecipesLoaded_search, pagesLoaded_s, searchValue);
    loadMoreSearchButton.style.display = 'block';
    loader.style.display = "none";

    // for each recipe add the 'add recipe' buttons
    const addRecipeButtons = document.querySelectorAll('#addRecipe');
    addRecipeButtons.forEach(button => {
        // onclick, get the recipe data and add it to the saved recipes
        let recipeId = button.getAttribute("data-recipe-id");
        let recipeTitle = button.getAttribute("data-recipe-title");
        let recipeImage = button.getAttribute("data-recipe-image");
        // console.log(recipeId);
        button.addEventListener("click", function() {
            addRecipe(recipeId, recipeTitle, recipeImage);
        });
    });
    prevSearchValue = searchValue;
});



async function loadRecipes(n, page = 0) {
    /**
     * Display recipe info for the scrolling menu
     * @param  {int} page  
     * @param  {int} numRecipes  number of recipes to load
     * @param  {String} query  user's input for their recommended meal
   */
    loader.style.display = "block";
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
                        <ul class="actions fit" style="font-size: 12px">
                            <li><a href="${redirect}" class="button primary fit icon solid fa-eye">View Recipe</a></li>
                            <li><a id="addRecipe" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${recipe.image}" class="button primary fit icon solid fa-download">Add Recipe</a></li>
                            <li><a href="${recipe.sourceUrl}" class="button icon solid fa-search">Visit Website</a></li>
                        </ul>
                    </div>`
        div.innerHTML = html;
        localStorage.setItem(recipe.id, JSON.stringify(recipe));
        while (div.children.length > 0) {
            container.appendChild(div.children[0]);
        }
        

    }
    loader.style.display = "none";
    const addRecipeButtons = document.querySelectorAll('#addRecipe');
        addRecipeButtons.forEach(button => {
            
            let recipeId = button.getAttribute("data-recipe-id");
            let recipeTitle = button.getAttribute("data-recipe-title");
            let recipeImage = button.getAttribute("data-recipe-image");
            // console.log(recipeId);
            button.addEventListener("click", function() {
                addRecipe(recipeId, recipeTitle, recipeImage);
            });
        });
    loadMorePopularButton.innerHTML = "Load More Recipes";
    loader.style.display = "none";
}


async function loadSearchedRecipes(numRecipesToLoad, pageOffset=0, searchQuery) {
    /**
     * Display recipe info for the search recipe menu
     * @param  {int} numRecipesToLoad   determines number of recipes to display
     * @param  {int} pageOffset  determines recipe offset
     * @param  {String} searchQuery  user's input for their recommended meal
   */
    loader.style.display = "block";
    // console.log(numRecipesToLoad,pageOffset);
    let recipes = await searchRecipes(pageOffset, numRecipesToLoad, searchQuery);
    // loadSearchedRecipes(numRecipesLoaded_search, pagesLoaded_s+numRecipesLoaded_search, prevSearchValue);
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
                        <ul class="actions fit" style="font-size: 12px">
                            <li><a href="${redirect}" class="button primary fit icon solid fa-eye">View Recipe</a></li>
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
    // Update 'load more' button
    loadMoreSearchButton.innerHTML = "Load More Recipes";
    loader.style.display = "none";
}

function addRecipe(id, title, image) {
    /**
     * adds a recipe's data to the user's saved meals in the database
     * @param  {String} id recipe's Spoonacular identification number
     * @param  {String} title  recipe title
     * @param  {String} image  a Recipe's image URL
   */
    
    var data = {'recipeId': id, 'recipeTitle': title, 'recipeImage': image};
    var recipeButton = document.querySelector(`[data-recipe-id="${id}"]`);
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

loadMoreSearchButton.addEventListener("click", () => {
    // loads more recipes for the 'searched' recipes
    loadMoreSearchButton.innerHTML = "Loading...";

    // display more recipes, given the number of recipes loaded, the offset, and the previous search query
    loadSearchedRecipes(numRecipesLoaded_search, pagesLoaded_s+numRecipesLoaded_search, prevSearchValue);
    pagesLoaded_s+=numRecipesLoaded_search;
    
    loader.style.display = "none";

    // for each recipe add the 'add recipe' buttons
    const addRecipeButtons = document.querySelectorAll('#addRecipe');
    addRecipeButtons.forEach(button => {
        // onclick, get the recipe data and add it to the saved recipes
        let recipeId = button.getAttribute("data-recipe-id");
        let recipeTitle = button.getAttribute("data-recipe-title");
        let recipeImage = button.getAttribute("data-recipe-image");
        // console.log(recipeId);
        button.addEventListener("click", function() {
            addRecipe(recipeId, recipeTitle, recipeImage);
        });
    });    
})

const loadMorePopularButton = document.querySelector(`#loadMorePopular`);
// loads more recipes for the popular recipes (the infinite scrolling one)
    loadMorePopularButton.addEventListener("click", () => {
    loadMorePopularButton.innerHTML = "Loading...";
    loadRecipes(numRecipesLoaded, pagesLoaded+numRecipesLoaded);
    
    pagesLoaded+=numRecipesLoaded;
    loader.style.display = "none";
    
    // for each recipe add the 'add recipe' buttons
    const addRecipeButtons = document.querySelectorAll('#addRecipe');
    addRecipeButtons.forEach(button => {
        // onclick, get the recipe data and add it to the saved recipes
        let recipeId = button.getAttribute("data-recipe-id");
        let recipeTitle = button.getAttribute("data-recipe-title");
        let recipeImage = button.getAttribute("data-recipe-image");
        // console.log(recipeId);
        button.addEventListener("click", function() {
            addRecipe(recipeId, recipeTitle, recipeImage);
        });
    });  
})

loadRecipes(4, 0);
                                                                        