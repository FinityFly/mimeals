export default class Recipe {
    constructor(aggregateLikes, analyzedInstructions, cheap, cookingMinutes, creditsText, cuisines, dairyFree, diets, dishTypes, extendedIngredients, gaps, glutenFree, healthScore, id, image, instructions, lowFodmap, occasions, preparationMinutes, pricePerServing, readyInMinutes, servings, sourceName, sourceUrl, spoonacularSourceUrl, summary, title, vegan, vegetarian, veryHealthy, veryPopular, weightWatcherSmartPoints) {
        this.aggregateLikes = aggregateLikes;
        this.analyzedInstructions = analyzedInstructions; 
        this.cheap = cheap;
        this.cookingMinutes = cookingMinutes; //used in guest-recipe.php
        this.creditsText = creditsText; //used in guest-recipe.php
        this.cuisines = cuisines;
        this.dairyFree = dairyFree; //used in guest-recipe.php
        this.diets = diets;
        this.dishTypes = dishTypes;
        this.extendedIngredients = extendedIngredients;
        this.gaps = gaps;
        this.glutenFree = glutenFree; //used in guest-recipe.php
        this.healthScore = healthScore; //used in guest-recipe.php
        this.id = id; 
        this.image = image; //used in guest-recipe.php
        this.instructions = instructions;
        this.lowFodmap = lowFodmap; //used in guest-recipe.php
        this.occasions = occasions;
        this.preparationMinutes = preparationMinutes; //used in guest-recipe.php
        this.pricePerServing = pricePerServing; //used in guest-recipe.php
        this.readyInMinutes = readyInMinutes; //used in guest-recipe.php
        this.servings = servings; //used in guest-recipe.php
        this.sourceName = sourceName;
        this.sourceUrl = sourceUrl; //used in guest-recipe.php
        this.spoonacularSourceUrl = spoonacularSourceUrl;
        this.summary = summary; //used in guest-recipe.php
        this.title = title; //used in guest-recipe.php
        this.vegan = vegan; //used in guest-recipe.php
        this.vegetarian = vegetarian; //used in guest-recipe.php
        this.veryHealthy = veryHealthy;
        this.veryPopular = veryPopular;
        this.weightWatcherSmartPoints = weightWatcherSmartPoints; //used in guest-recipe.php
    }
}