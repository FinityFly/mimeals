import Recipe from './recipe.js';
require('dotenv').config()

const container = document.querySelector('.row');
console.log("sup!");

let apiKey = process.env.SPOONACULAR_KEY; // put into dotenv later

async function fetchResponse(query) {
    let response = await fetch(query);
    let data = await response.json();
    return data;
}

async function getRecipeData(id) {
    let query = `https://api.spoonacular.com/recipes/${id}/information?apiKey=${apiKey}`;
    let data = await fetchResponse(query);
    console.log(data);
    console.log(data.aggregateLikes);
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
    return recipes
}

async function loadRecipes(numRecipes) {
    let recipes = await getRecipes([], 0, numRecipes);
    for (let i = 0; i < recipes.length; i++) {
        let recipe = recipes[i];
        let div = document.createElement('div');
        div.className = 'col-6 col-12-small';
        let html = `<a href="#">
                    <span class="image fit"><img src="${recipe.image}" alt="" /></span>
                    <h2>${recipe.title}</h2>
                    </a>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <ul class="actions fit">
                        <li><a href="#" class="button primary fit icon solid fa-download">Add to Recipes</a></li>
                        <li><a href="${recipe.sourceUrl}" class="button fit icon solid fa-search">Visit Website</a></li>
                    </ul>`;
        div.innerHTML = html;
        while (div.children.length > 0) {
            container.appendChild(div.children[0]);
        }
    }
}

await loadRecipes(2);

// let recipes = await getRecipes([], 0, 2);
// console.log(recipes[0]);
// console.log(recipes[0].keys());
