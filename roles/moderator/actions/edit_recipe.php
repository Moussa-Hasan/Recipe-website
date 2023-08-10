<?php

session_start();

if (!isset($_SESSION['EmailModerator']))
    header("location:../../../index.php");

include "../../../includes/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator page</title>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../moderator.php">Recipe Website Moderator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item">
          <a class="nav-link" href="../../includes/logout.php">Sign out</a>
        </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="../manageRecipes.php">Go Back</a>
                </li>

            </ul>
        </div>
    </nav>

    <!-- Page Content -->

    <!-- add recipe form  -->

    <br>
    <?php
    // Establish a database connection
    include "../../../includes/connection.php";

    if (isset($_GET['recipe_id'])) {

        $recipe_id = mysqli_real_escape_string($con, $_GET['recipe_id']);

        $recipe_sql = "SELECT * FROM recipes WHERE recipe_id = '$recipe_id'";

        $recipe_result = mysqli_query($con, $recipe_sql);
        $recipe_row = mysqli_fetch_assoc($recipe_result);

        if (!$recipe_row) {

            header("Location:../manageRecipes.php");
            exit;
        }

        $info_sql = "SELECT * FROM recipes_info WHERE recipe_id = '$recipe_id'";
        $info_result = mysqli_query($con, $info_sql);
        $info_row = mysqli_fetch_assoc($info_result);

        $ingredient_sql = "SELECT * FROM recipes_ingredients WHERE recipe_id = '$recipe_id'";
        $ingredient_result = mysqli_query($con, $ingredient_sql);

        $step_sql = "SELECT * FROM recipes_steps WHERE recipe_id = '$recipe_id'";
        $step_result = mysqli_query($con, $step_sql);

        // $user_sql = "SELECT first_name, last_name, user_id FROM login_users WHERE user_id = '" . $recipe_row["user_id"] . "'";
        // $user_result = mysqli_query($con, $user_sql);
        // $user_row = mysqli_fetch_assoc($user_result);

    }

    ?>
    <div class="container border p-3">
        <h2>Edit a recipe form</h2><br>
        <h4 style="color: red;">You are allowed to change the nutritional information only</h4><br>
        <form id="myForm" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="recipe_name">Recipe Name:</label> <a href="../../../images/<?php echo $recipe_row["image"] ?>"> <?php echo $recipe_row["image"] ?> </a>
                <input type="text" class="form-control" id="recipe_name" name="txtRecipeName" value="<?php echo $recipe_row['name'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="recipe_description">Recipe Description:</label>
                <textarea class="form-control" id="recipe_description" name="txtRecipeDescription" rows="3" readonly><?php echo $recipe_row['description'] ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="prep_time">Preparation Time (in minutes):</label>
                    <input type="number" class="form-control" id="prep_time" name="txtPrepTime" min="0" max="240" value="<?php echo $recipe_row['preparation_time'] ?>" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="cook_time">Cooking Time (in minutes):</label>
                    <input type="number" class="form-control" id="cook_time" name="txtCookTime" min="0" max="240" value="<?php echo $recipe_row['cooking_time'] ?>" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="total_time">Total Time (in minutes):</label>
                    <input type="number" class="form-control" id="total_time" value="<?php echo $recipe_row['total_time'] ?>" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="servings">Servings:</label>
                    <input type="number" class="form-control" id="servings" name="txtServings" min="1" max="1000" value="<?php echo $recipe_row['servings'] ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="mealTime">Meal Time</label>
                    <input type="text" class="form-control" id="mealTime" name="txtMealTime" value="<?php echo $recipe_row['meal_time']; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="cuisine">Cuisine</label>
                    <input type="text" class="form-control" id="cuisine" name="txtCuisine" value="<?php echo $recipe_row['cuisine']; ?>" readonly>
                </div>
            </div>
            <div id="ingredientContainer">
                <div class="form-group ingredient-form">
                    <!-- <label for="ingredient1">Please put the # sign at the end of every ingredient except last one.</label> -->
                    <div class="input-group">
                        <label for="ingredient1" class="input-group-text">Ingredients :</label>
                        <textarea class="form-control" id="ingredient1" name="txtIngredients" rows="3" readonly><?php
                                                                                                                while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                                                                                                                    $ingredient = trim($ingredient_row['ingredient']);
                                                                                                                    echo $ingredient . "\n\n";
                                                                                                                } ?>
                        </textarea>
                        <!-- <button type="button" class="btn btn-danger remove-ingredient">Remove</button> -->
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-primary add-ingredient">Add New Ingredient</button> -->
            <hr>
            <div id="stepContainer">
                <div class="form-group step-form">
                    <!-- <label for="step1">Please put the # sign at the end of every step except last one.</label> -->
                    <div class="input-group">
                        <label for="step1" class="input-group-text">Steps :</label>
                        <textarea class="form-control" id="step1" name="txtSteps" rows="3" readonly><?php
                                                                                                    while ($step_row = mysqli_fetch_assoc($step_result)) {
                                                                                                        $step = trim($step_row['step']);
                                                                                                        echo $step . "\n\n";
                                                                                                    } ?>
                        </textarea>
                        <!-- <button type="button" class="btn btn-danger remove-step">Remove</button> -->
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-primary add-step">Add New Step</button> -->
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="calories">Calories:</label>
                    <input type="number" class="form-control" id="calories" name="txtCalories" min="0" value="<?php echo $info_row['calories'] ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="carbs">Carbs (g):</label>
                    <input type="number" class="form-control" id="carbs" name="txtCarbs" min="0" value="<?php echo $info_row['carbs'] ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="fat">Fat (g):</label>
                    <input type="number" class="form-control" id="fat" name="txtFat" min="0" value="<?php echo $info_row['fat'] ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="protein">Protein (g):</label>
                    <input type="number" class="form-control" id="protein" name="txtProtein" min="0" value="<?php echo $info_row['protein'] ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div><br>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // recipe
        $id = $_SESSION['EmailModerator'];

        // nutritional info
        $calories = mysqli_real_escape_string($con, $_POST['txtCalories']);
        $carbs = mysqli_real_escape_string($con, $_POST['txtCarbs']);
        $fat = mysqli_real_escape_string($con, $_POST['txtFat']);
        $protein = mysqli_real_escape_string($con, $_POST['txtProtein']);

        // others
        $user_id = $_SESSION['moderatorId'];

        $sql1 = "UPDATE recipes_info SET recipe_id = '$recipe_id', calories = '$calories', carbs = '$carbs',
    fat = '$fat', protein = '$protein'
WHERE recipe_id = '$recipe_id'";
        mysqli_query($con, $sql1) or die(mysqli_error($con));

        echo '<script>window.location.href = "../manageRecipes.php";</script>';
        exit;
    }


    ?>

    <script src="../../../js/popper.min.js"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/bootstrap.js"></script>

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