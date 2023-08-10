<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../../index.php");

include "../../../includes/connection.php";

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

      move_uploaded_file($file_tmp, "../../../images/" . $file_name);
      // echo "Success";
    } else {
      print_r($errors);
    }
  }

  // recipe
  $id = $_SESSION['EmailAdmin'];
  $name = mysqli_real_escape_string($con, $_POST['txtRecipeName']);
  $description = mysqli_real_escape_string($con, $_POST['txtRecipeDescription']);
  $prep_time = mysqli_real_escape_string($con, $_POST['txtPrepTime']);
  $cook_time = mysqli_real_escape_string($con, $_POST['txtCookTime']);
  $total_time = $prep_time + $cook_time;
  $servings = mysqli_real_escape_string($con, $_POST['txtServings']);
  $meal_time = mysqli_real_escape_string($con, $_POST['txtMealTime']);
  $cuisine = mysqli_real_escape_string($con, $_POST['txtCuisine']);
  $status = "approved";

  // nutritional info
  $calories = mysqli_real_escape_string($con, $_POST['txtCalories']);
  $carbs = mysqli_real_escape_string($con, $_POST['txtCarbs']);
  $fat = mysqli_real_escape_string($con, $_POST['txtFat']);
  $protein = mysqli_real_escape_string($con, $_POST['txtProtein']);

  // others
  $create_date = date('Y-m-d H:i:s');
  $user_id = $_SESSION['adminId'];


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

header("location:../addRecipes.php");

?>