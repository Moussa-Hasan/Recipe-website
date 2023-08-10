<?php

session_start();

if (!isset($_SESSION['EmailUser']))
  header("location:../../index.php");

include "../../includes/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_FILES['txtFile'])) {

    $errors = array();

    $file_name = $_FILES['txtFile']['name'];
    $file_size = $_FILES['txtFile']['size'];
    $file_tmp = $_FILES['txtFile']['tmp_name'];
    $file_type = $_FILES['txtFile']['type'];
    $file_parts = explode('.', $_FILES['txtFile']['name']);
    $file_ext = strtolower(end($file_parts));
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
      $errors[] = 'extension not allowed, please choose a JPEG or PNG file.';
    }
    if ($file_size > 2097152) {
      $errors[] = 'File size must be excately 2 MB';
    }
    if (empty($errors) == true) {

      move_uploaded_file($file_tmp, "../../images/" . $file_name);
      // echo "Success";
    } else {
      print_r($errors);
    }
  }

  // recipe
  $id = $_SESSION['EmailUser'];
  $name = mysqli_real_escape_string($con, $_POST['txtRecipeName']);
  $description = mysqli_real_escape_string($con, $_POST['txtRecipeDescription']);
  $prep_time = mysqli_real_escape_string($con, $_POST['txtPrepTime']);
  $cook_time = mysqli_real_escape_string($con, $_POST['txtCookTime']);
  $total_time = $prep_time + $cook_time;
  $servings = mysqli_real_escape_string($con, $_POST['txtServings']);
  $meal_time = mysqli_real_escape_string($con, $_POST['txtMealTime']);
  $cuisine = mysqli_real_escape_string($con, $_POST['txtCuisine']);
  $status = "pending";

  // nutritional info
  $calories = mysqli_real_escape_string($con, $_POST['txtCalories']);
  $carbs = mysqli_real_escape_string($con, $_POST['txtCarbs']);
  $fat = mysqli_real_escape_string($con, $_POST['txtFat']);
  $protein = mysqli_real_escape_string($con, $_POST['txtProtein']);

  // others
  $create_date = date('Y-m-d H:i:s');
  $user_id = $_SESSION['userId'];


  // Save data to database 
  $sql = "INSERT INTO recipes (user_id, name, description, create_date, preparation_time, cooking_time, total_time, servings, meal_time, cuisine, image, status)
VALUES ('$user_id', '$name', '$description','$create_date', '$prep_time', '$cook_time', '$total_time', '$servings', '$meal_time', '$cuisine', '$file_name', '$status')";
  mysqli_query($con, $sql) or die(mysqli_error($con));

  // Get the ID of the newly inserted recipe
  $recipe_id = mysqli_insert_id($con);

  $sql1 = "INSERT INTO recipes_info (recipe_id, calories, carbs, fat, protein)
VALUES ('$recipe_id', '$calories', '$carbs', '$fat', '$protein')";
  mysqli_query($con, $sql1) or die(mysqli_error($con));

  // Get the ingredients from the form

  $ingredients = $_POST['txtIngredients'];
  // $ingredients_array = explode('#', str_replace(' ', '', $ingredients));
  $ingredients_array = explode('#', ($ingredients));


  // Insert the ingredients into the database

  foreach ($ingredients_array as $ingredient) {
    $ingredient = trim($ingredient);
    $ingredient = mysqli_real_escape_string($con, $ingredient);
    $sql = "INSERT INTO recipes_ingredients (recipe_id, ingredient) VALUES ('$recipe_id', '$ingredient')";
    mysqli_query($con, $sql);
  }



  // Get the steps from the form
  $steps = $_POST['txtSteps'];
  $steps_array = explode('#', ($steps));

  // Insert the steps into the database
  foreach ($steps_array as $step) {
    $step = trim($step);
    $step = mysqli_real_escape_string($con, $step);
    $sql = "INSERT INTO recipes_steps (recipe_id, step) VALUES ('$recipe_id', '$step')";
    mysqli_query($con, $sql);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome page</title>

  <!-- Custom CSS -->
  <style>
    body {
      /* background-color: #F8EDE3; */
      background-color: #f8f9f9;
    }

    /* .navbar { */
    /* background-color: #e3e3e3; */
    /* color: rgba(124, 110, 235, 0.159); */
    /* } */

    .recipe li {
      font-family: 'Playfair Display', serif;
    }

    .footer {
      background-color: #ededed;
      color: rgb(29, 26, 26);
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    /* .hero-section {
      background-image: url('../../images/h1_hero.png');
      background-size: cover;
      background-position: center center;
      height: 100vh;
    } */

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    h1 {
      font-family: 'Playfair Display', serif;
    }
  </style>
</head>

<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/edited_stylesheet.css">
<link rel="stylesheet" href="../../fontawesome-free-6.4.0-web/css/all.css">

<body>

  <!-- Main content begin -->

  <!-- <section class="hero-section">
    <div class="hero-content"> -->

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a href="welcome.php"> <img src="../../images/logo.png" alt="Logo" width="52" height="52" style="margin-right: 10px;">
    </a>
    <!-- <a class="navbar-brand" href="index.php" style="font-family: 'Playfair Display', serif;">Taste Trail</a> -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse  justify-content-center" id="navbarNav">
      <div>
        <ul class="navbar-nav recipe">
          <!-- <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="welcome.php">Go Back</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manageRecipes.php">My Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="favorites.php">Favorites</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cuisines
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Lebanese</a>
              <a class="dropdown-item" href="#">Italian</a>
              <a class="dropdown-item" href="#">Mexican</a>
              <a class="dropdown-item" href="#">Chinese</a>
              <a class="dropdown-item" href="#">Indian</a>
              <a class="dropdown-item" href="#">German</a>
              <a class="dropdown-item" href="#">Greek</a>
              <a class="dropdown-item" href="#">Japanese</a>
              <a class="dropdown-item" href="#">Filipino</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="kitchen_tips.php">Kitchen Tips</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">About Us</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="#" id="search-link">Search</a>
          </li> -->
          <!-- <li class="nav-item">
      <a class="nav-link" href="#">Contact Us</a>
    </li> -->
          <li class="nav-item">
            <!-- <button type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2"> -->
            <a type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2" href="../../includes/logout.php">Logout</a>
            <!-- </button>   -->
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <h1>Welcome to My Website</h1>
    <p>Here you'll find all kinds of great content.</p> -->
  <!-- </div>

  </section> -->

  <!-- <div id="search-popup">
    <form action="search.php">
      <input type="text" placeholder="Search...">
      <button type="submit">Go</button>
    </form>
  </div> -->

  <br>

  <!-- Meal planning -->

  <!-- <div class="container">
    <h2 class="text-center mb-4">Meal Planning</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h4 class="card-title">Monday</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Breakfast: Scrambled eggs and toast</li>
              <li class="list-group-item">Lunch: Grilled chicken salad</li>
              <li class="list-group-item">Dinner: Baked salmon and roasted vegetables</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h4 class="card-title">Tuesday</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Breakfast: Greek yogurt and fruit</li>
              <li class="list-group-item">Lunch: Turkey sandwich and fruit</li>
              <li class="list-group-item">Dinner: Beef stir-fry with rice</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
  </div> -->

  <br>

  <div class="container border p-3">
    <h2 style="text-align: center; font-family: 'Playfair Display', serif;">Add a new recipe</h2><br>
    <form id="myForm" action="" method="POST" enctype="multipart/form-data">
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

  <br>


  <!-- Main content end -->

  <!-- Footer begin -->
  <footer class="footer bg-light" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h4>About Us</h4>
          <p>We are passionate about sharing delicious recipes from around the world. Our team of expert chefs and food enthusiasts carefully curates each recipe to ensure that it is easy to follow and yields amazing results every time.</p>
        </div>
        <div class="col-lg-4">
          <h4>Explore</h4>
          <ul class="list-unstyled">
            <li><a href="#recipes">Recipes</a></li>
            <!-- <li><a href="#">Ingredients</a></li> -->
            <li><a href="#">Cooking Techniques</a></li>
            <li><a href="kitchen_tips.php">Kitchen Tips</a></li>
            <!-- <li><a href="#">Videos</a></li> -->
            <!-- <li><a href="#">Blog</a></li> -->
          </ul>
        </div>
        <div class="col-lg-4">
          <h4>Contact Us</h4>
          <ul class="list-unstyled">
            <li><i class="fas fa-map-marker-alt"></i> 15 Main St. Beirut, LEBANON 1600</li>
            <li><i class="fas fa-phone"></i> 00961 03129187</li>
            <li><i class="fas fa-envelope"></i> info@myrecipewebsite.com</li>
          </ul>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12 text-center">
          <p class="text-muted mb-0">&copy; 2023 Taste Trail Website. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Get the search link and search popup elements
    const searchLink = document.getElementById('search-link');
    const searchPopup = document.getElementById('search-popup');

    // Add a click event listener to the search link
    searchLink.addEventListener('click', (event) => {
      // Prevent the default behavior of the link (i.e. following the href)
      event.preventDefault();

      // Show the search form popup
      searchPopup.style.display = 'block';
    });

    // Add a click event listener to the search popup
    searchPopup.addEventListener('click', (event) => {
      // Stop the event propagation
      event.stopPropagation();
    });

    // Add a click event listener to the document
    document.addEventListener('click', (event) => {
      // Check if the clicked element is not the search link or the search popup
      if (event.target !== searchLink && event.target !== searchPopup) {
        // Hide the search form popup
        searchPopup.style.display = 'none';
      }
    });

    // Get the "About Us" link
    const aboutLink = document.querySelector('a[href="#footer"]');

    // Add a click event listener to the link
    aboutLink.addEventListener('click', function(event) {
      // Prevent the default link behavior
      event.preventDefault();

      // Get the target element (the footer)
      const target = document.querySelector('#footer');

      // Calculate the distance from the top of the page to the target element
      const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;

      // Scroll smoothly to the target element
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    });

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

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>