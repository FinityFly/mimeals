<!-- is this even used?? -->

<?php



// clean data input


// ISSUE:SUBMITTING MULTIPLE THINGS IN 1 SESSION, where its already set in a previous response. Do I need a $_POST['recipe-title'][0] or smth
// $sql = 'INSERT INTO () VALUES ()';

// $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`, `time`)  VALUES (NULL, '$userId', '$recipeId', '$recipeTitle', '$recipeImage', '$time')";
// mysqli_query($conn, $sql);

?>	

<?php
include "db-conn.php";

function cleanData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// recipe description
$recipeTitle = cleanData($_POST['recipe-title']);
$recipeDescription = cleanData($_POST['recipe-description']);

// recipe stats
$prepTime = cleanData($_POST['Preperation Time']);
$cookTime = cleanData($_POST['Cook Time']);
$totalTime = int($prepTime)+int($cookTime);
$servings = cleanData($_POST['Servings']);
$pps = cleanData($_POST['PPS']);

// image uuhhhhhhhhhhhhh

// recipe ingredients and steps
$recipeSteps = 

// create meal




// save meal? 


// if its submitted, then try it out?
if (isset($_POST['recipe-title'])){
}
// if ($bucketlist < 1) {
//     $userId = $_SESSION['userId'];
//     $recipeId = $_GET['recipeId'];
//     $recipeTitle = $_GET['recipeTitle'];
//     $recipeImage = $_GET['recipeImage'];=

//     $sql = "INSERT INTO `addedRecipes` (`id`, `userId`, `recipeId`, `recipeTitle`, `recipeImage`)  VALUES (NULL, '$userId', '$recipeId', '$recipeTitle', '$recipeImage')";
//     mysqli_query($conn, $sql);
//     return json_encode(array("status" => true, "added" => true));
// } else {
//     return json_encode(array("status" => true, "added" => false));
// }


?>
<!DOCTYPE HTML>
<html>
<script>

// constructor(aggregateLikes, analyzedInstructions, cheap, cookingMinutes, creditsText, cuisines, dairyFree, diets, dishTypes, extendedIngredients, gaps, glutenFree, healthScore, id, image, instructions, lowFodmap, occasions, preparationMinutes, pricePerServing, readyInMinutes, servings, sourceName, sourceUrl, spoonacularSourceUrl, summary, title, vegan, vegetarian, veryHealthy, veryPopular, weightWatcherSmartPoints) {
//         this.aggregateLikes = aggregateLikes;
//         this.analyzedInstructions = analyzedInstructions; 
//         this.cheap = cheap;
//         this.cookingMinutes = cookingMinutes; //used in guest-recipe.php
//         this.creditsText = creditsText; //used in guest-recipe.php
//         this.cuisines = cuisines;
//         this.dairyFree = dairyFree; //used in guest-recipe.php
//         this.diets = diets;
//         this.dishTypes = dishTypes;
//         this.extendedIngredients = extendedIngredients;
//         this.gaps = gaps;
//         this.glutenFree = glutenFree; //used in guest-recipe.php
//         this.healthScore = healthScore; //used in guest-recipe.php
//         this.id = id; 
//         this.image = image; //used in guest-recipe.php
//         this.instructions = instructions;
//         this.lowFodmap = lowFodmap; //used in guest-recipe.php
//         this.occasions = occasions;
//         this.preparationMinutes = preparationMinutes; //used in guest-recipe.php
//         this.pricePerServing = pricePerServing; //used in guest-recipe.php
//         this.readyInMinutes = readyInMinutes; //used in guest-recipe.php
//         this.servings = servings; //used in guest-recipe.php
//         this.sourceName = sourceName;
//         this.sourceUrl = sourceUrl; //used in guest-recipe.php
//         this.spoonacularSourceUrl = spoonacularSourceUrl;
//         this.summary = summary; //used in guest-recipe.php
//         this.title = title; //used in guest-recipe.php
//         this.vegan = vegan; //used in guest-recipe.php
//         this.vegetarian = vegetarian; //used in guest-recipe.php
//         this.veryHealthy = veryHealthy;
//         this.veryPopular = veryPopular;
//         this.weightWatcherSmartPoints = weightWatcherSmartPoints; //used in guest-recipe.php
//     }
	let customRecipe= new Recipe(null, null, null , cookingMinutes, creditsText, null, dairyFree, null, null, null, null, glutenFree, healthScore, null, image, null, lowFodmap, null, preparationMinutes, pricePerServing, readyInMinutes, servings, null, sourceUrl, null, summary, title, vegan, vegetarian, null, null, weightWatcherSmartPoints)
</script>
</html>
