<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../index.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard page</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Recipe Website Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href="../../includes/logout.php">Sign out</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Go Back</a>
        </li>

      </ul>
    </div>
  </nav>

  <!-- Page Content -->

  <!-- add recipe form  -->

  <br>
  <div class="container border p-3">
    <h2>Add a new recipe form</h2><br>
    <form id="myForm" action="actions/recipe_adding.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="recipe_name">Recipe Name:</label>
        <input type="text" class="form-control" id="recipe_name" name="txtRecipeName" required>
      </div>
      <div class="form-group">
        <label for="recipe_description">Recipe Description:</label>
        <textarea class="form-control" id="recipe_description" name="txtRecipeDescription" rows="3" required></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="prep_time">Preparation Time (in minutes):</label>
          <input type="number" class="form-control" id="prep_time" name="txtPrepTime" min="0" max="240" required>
        </div>
        <div class="form-group col-md-3">
          <label for="cook_time">Cooking Time (in minutes):</label>
          <input type="number" class="form-control" id="cook_time" name="txtCookTime" min="0" max="240" required>
        </div>
        <div class="form-group col-md-3">
          <label for="total_time">Total Time (in minutes):</label>
          <input type="number" class="form-control" id="total_time" readonly>
        </div>
        <div class="form-group col-md-3">
          <label for="servings">Servings:</label>
          <input type="number" class="form-control" id="servings" name="txtServings" min="1" max="1000" required>
        </div>
        <div class="form-group col-md-6">
          <label for="mealTime">Meal Time</label>
          <select class="form-control" id="mealTime" name="txtMealTime">
            <!-- <option value="">Any</option> -->
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
            <option value="snack">Snack</option>
            <option value="dessert">Dessert</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="cuisine">Cuisine</label>
          <select class="form-control" id="cuisine" name="txtCuisine">
            <option value="lebanese">Lebanese</option>
            <option value="italian">Italian</option>
            <option value="mexican">Mexican</option>
            <option value="indian">Indian</option>
            <option value="chinese">Chinese</option>
            <option value="german">German</option>
            <option value="greek">Greek</option>
            <option value="japanese">Japanese</option>
            <option value="filipino">Filipino</option>
          </select>
        </div>
      </div>
      <div id="ingredientContainer">
        <div class="form-group ingredient-form">
          <label for="ingredient1">Please put the # sign at the end of every ingredient except last one.</label>
          <div class="input-group">
            <label for="ingredient1" class="input-group-text">Ingredients :</label>
            <textarea class="form-control" id="ingredient1" name="txtIngredients" rows="3" required></textarea>
            <!-- <button type="button" class="btn btn-danger remove-ingredient">Remove</button> -->
          </div>
        </div>
      </div>
      <!-- <button type="button" class="btn btn-primary add-ingredient">Add New Ingredient</button> -->
      <hr>
      <div id="stepContainer">
        <div class="form-group step-form">
          <label for="step1">Please put the # sign at the end of every step except last one.</label>
          <div class="input-group">
            <label for="step1" class="input-group-text">Steps :</label>
            <textarea class="form-control" id="step1" name="txtSteps" rows="3" required></textarea>
            <!-- <button type="button" class="btn btn-danger remove-step">Remove</button> -->
          </div>
        </div>
      </div>
      <!-- <button type="button" class="btn btn-primary add-step">Add New Step</button> -->
      <div class="form-group">
        <label for="recipe_image">Recipe Image:</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="recipe_image" name="txtFile">
          <label class="custom-file-label" for="recipe_image">Choose file</label>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="calories">Calories:</label>
          <input type="number" class="form-control" id="calories" name="txtCalories" min="0" required>
        </div>
        <div class="form-group col-md-3">
          <label for="carbs">Carbs (g):</label>
          <input type="number" class="form-control" id="carbs" name="txtCarbs" min="0" required>
        </div>
        <div class="form-group col-md-3">
          <label for="fat">Fat (g):</label>
          <input type="number" class="form-control" id="fat" name="txtFat" min="0" required>
        </div>
        <div class="form-group col-md-3">
          <label for="protein">Protein (g):</label>
          <input type="number" class="form-control" id="protein" name="txtProtein" min="0" required>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div><br>

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>

  <script>
    //combine prep time and cock time

    var prepTime = document.getElementById("prep_time");
    var cookTime = document.getElementById("cook_time");
    var totalTime = document.getElementById("total_time");

    function calculateTotalTime() {
      var prepTimeValue = parseInt(prepTime.value);
      var cookTimeValue = parseInt(cookTime.value);
      var total = isNaN(prepTimeValue) ? 0 : prepTimeValue;
      total += isNaN(cookTimeValue) ? 0 : cookTimeValue;
      totalTime.value = total;
    }

    prepTime.addEventListener("input", calculateTotalTime);
    cookTime.addEventListener("input", calculateTotalTime);
  </script>
</body>

</html>