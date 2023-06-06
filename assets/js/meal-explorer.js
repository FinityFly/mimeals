import Recipe from './recipeObj.js';

const container = document.querySelector('.row');
const pageContainer = document.querySelector('.pagination');

let apiKey = "dc09bd6aec87426f9b4a4c30ddaf204f"; // put into dotenv later
let apiKey2 = "3f043de69de544e6b333d34d97e988c7";
apiKey = apiKey2;

async function fetchResponse(query) {
    let response = await fetch(query);
    let data = await response.json();
    return data;
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


// When any recipe's "add Recipe" buttons is clicked, 
// pass the recipe's Id, Title, and Image to the addRecipe function, 
// where it will be added to the user's saved meals database.
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

// here, n is the beginning number. There will be 10 pages loaded at a time
function loadPages(n){
    n = parseInt(n);

    let div = document.createElement('div');
    let html = `<li><span class="button" id = prevPage>Prev</span></li>`
    div.innerHTML = html;
    pageContainer.appendChild(div.children[0]);

    for (let i = 1; i < 6; i++) {
        if (i==1){
            html = `<li><a href="#" class="pagination page active" id ='${n+i}'>${n+i}</a></li>`
        }else{
            html = `<li><a href="#" class="pagination page" id ='${n+i}'>${n+i}</a></li>`
        }
        
        
        div.innerHTML = html;
        pageContainer.appendChild(div.children[0]);
        // while (div.children.length > 0) {
        //     pageContainer.appendChild(div.children[0]);
        // }
    }
    
    let next = `<li><span class="button" id = nextPage>Next</span></li>`
    div.innerHTML = next;
    pageContainer.appendChild(div.children[0]);

    // whats the diff between const and var here... ig none

    var prevPage = document.querySelector(`#prevPage`);
    prevPage.addEventListener("click", () => {
        if (n>0){
            clearPages()
            loadPages(n-1);
            loadRecipes(6, n-1);
        }
    })

    const pageButtons = document.querySelectorAll('.page');
    pageButtons.forEach(button => {
    button.addEventListener("click", function() {

        clearPages()
        loadPages(button.id);
        loadRecipes(6, button.id);
    });

    var nextPage = document.querySelector(`#nextPage`);
    nextPage.addEventListener("click", () => {
        clearPages()
        loadPages(n+1);
        loadRecipes(6, n+1);
    })

});

    
}


function clearPages(){
    // https://stackoverflow.com/questions/3955229/remove-all-child-elements-of-a-dom-node-in-javascript
    while (pageContainer.firstChild) {
        pageContainer.removeChild(pageContainer.lastChild);
    }
}

loadPages(0);
loadRecipes(6, 0);
