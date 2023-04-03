import Recipe from './recipe.js';

let apiKey = "dc09bd6aec87426f9b4a4c30ddaf204f"; // put into dotenv later

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

async function getRecipes(args, page) {
    let recipes = [];
    if (args.length == 0) {
        // sort by popularity
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity&offset=${page*10}&number=10`;
        let data = await fetchResponse(query);
        for (let i = 0; i < data.results.length; i++) {
            recipes.push(await getRecipeData(data.results[i].id));
        }
    } else {
        // do later
        let query = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&sort=popularity`;
        let data = fetchResponse(query);
    }
    return recipes
}

let recipes = await getRecipes([], 0);
console.log(recipes[0]);
console.log(recipes[0].title);