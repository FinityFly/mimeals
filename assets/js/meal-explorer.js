import Recipe from './recipeObj.js';

const container = document.querySelector('.row');

let apiKey = "dc09bd6aec87426f9b4a4c30ddaf204f"; // put into dotenv later

async function fetchResponse(query) {
    let response = await fetch(query);
    let data = await response.json();
    return data;
}

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

async function loadRecipes(n) {
    let recipes = await getRecipes([], 0, n);
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

await loadRecipes(2);

const addRecipeButtons = document.querySelectorAll("#addRecipe");

addRecipeButtons.forEach(button => {
    let recipeId = button.getAttribute("data-recipe-id");
    let recipeTitle = button.getAttribute("data-recipe-title");
    let recipeImage = button.getAttribute("data-recipe-image");
    button.addEventListener("click", function() {
        addRecipe(recipeId, recipeTitle, recipeImage);
    });
});

function addRecipe(id, title, image) {
    console.log('STARTING ADDING RECIPE'); 
    // var data = {'recipeId': id, 'recipeTitle': title, 'recipeImage': image};
    var data = {'recipeId': '152368'}
    $.ajax({
        processData: false,
        async: true,
        'url': './includes/add-recipe.php', 
        'type': 'POST',
        'dataType': 'json',
        timeout: 3000,
        'data': JSON.stringify(data),
        'success': function(res) {
            console.log("SUCCESS");
            console.log(res);
            // if (res.status) {
            //     if (res.added) {
            //         console.log("item added");
            //         // $("span#success"+recipeId).attr("innerHTML","Item added to your personal list");
            //     } else {
            //         console.log("item already added")
            //         // $("span#success"+recipeId).attr("innerHTML","This item is already on your list");
            //     }
            // }
        },
        'error': function(res) {
            console.log("ERROR");
            console.log(res);
            // this is what happens if the request fails.
            // $("span#success"+recipeId).attr("innerHTML","An error occureed");
        }
    });
};