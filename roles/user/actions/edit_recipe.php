<?php

session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../../index.php");

include "../../../includes/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/edited_stylesheet.css">
    <link rel="stylesheet" href="../../../fontawesome-free-6.4.0-web/css/all.css">

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

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="../welcome.php"> <img src="../../../images/logo.png" alt="Logo" width="52" height="52" style="margin-right: 10px;">
        </a>
        <!-- <a class="navbar-brand" href="index.php" style="font-family: 'Playfair Display', serif;">Taste Trail</a> -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  justify-content-center" id="navbarNav">
            <div>
                <ul class="navbar-nav recipe">
                    <li class="nav-item">
                        <a class="nav-link" href="../manageRecipes.php">Go Back</a>
                    </li>
                    <li class="nav-item">
                        <!-- <button type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2"> -->
                        <a type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2" href="../../includes/logout.php">Logout</a>
                        <!-- </button>   -->
                    </li>
                </ul>
            </div>
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
        <form id="myForm" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="recipe_name">Recipe Name:</label>
                <input type="text" class="form-control" id="recipe_name" name="txtRecipeName" value="<?php echo $recipe_row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="recipe_description">Recipe Description:</label>
                <textarea class="form-control" id="recipe_description" name="txtRecipeDescription" rows="3" required><?php echo $recipe_row['description'] ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="prep_time">Preparation Time (in minutes):</label>
                    <input type="number" class="form-control" id="prep_time" name="txtPrepTime" min="0" max="240" value="<?php echo $recipe_row['preparation_time'] ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="cook_time">Cooking Time (in minutes):</label>
                    <input type="number" class="form-control" id="cook_time" name="txtCookTime" min="0" max="240" value="<?php echo $recipe_row['cooking_time'] ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="total_time">Total Time (in minutes):</label>
                    <input type="number" class="form-control" id="total_time" value="<?php echo $recipe_row['total_time'] ?>" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="servings">Servings:</label>
                    <input type="number" class="form-control" id="servings" name="txtServings" min="1" max="1000" value="<?php echo $recipe_row['servings'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="mealTime">Meal Time</label>
                    <select class="form-control" id="mealTime" name="txtMealTime">
                        <option value="<?php echo $recipe_row['meal_time']; ?>"><?php echo $recipe_row['meal_time']; ?></option>
                        <optgroup label="Choose a differnt time">
                            <option value="">Any</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snack">Snack</option>
                            <option value="dessert">Dessert</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="cuisine">Cuisine</label>
                    <select class="form-control" id="cuisine" name="txtCuisine">
                        <option value="<?php echo $recipe_row['cuisine']; ?>"><?php echo $recipe_row['cuisine']; ?></option>
                        <optgroup label="Choose a differnt cuisine">
                            <option value="lebanese">Lebanese</option>
                            <option value="italian">Italian</option>
                            <option value="mexican">Mexican</option>
                            <option value="indian">Indian</option>
                            <option value="chinese">Chinese</option>
                            <option value="german">German</option>
                            <option value="greek">Greek</option>
                            <option value="japanese">Japanese</option>
                            <option value="filipino">Filipino</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div id="ingredientContainer">
                <div class="form-group ingredient-form">
                    <label for="ingredient1">Please put the # sign at the end of every ingredient except last one.</label>
                    <div class="input-group">
                        <label for="ingredient1" class="input-group-text">Ingredients :</label>
                        <textarea class="form-control" id="ingredient1" name="txtIngredients" rows="3" required><?php
                                                                                                                while ($ingredient_row = mysqli_fetch_assoc($ingredient_result)) {
                                                                                                                    $ingredient = trim($ingredient_row['ingredient']);
                                                                                                                    echo $ingredient . "#\n\n";
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
                    <label for="step1">Please put the # sign at the end of every step except last one.</label>
                    <div class="input-group">
                        <label for="step1" class="input-group-text">Steps :</label>
                        <textarea class="form-control" id="step1" name="txtSteps" rows="3" required><?php
                                                                                                    while ($step_row = mysqli_fetch_assoc($step_result)) {
                                                                                                        $step = trim($step_row['step']);
                                                                                                        echo $step . "#\n\n";
                                                                                                    } ?>
                        </textarea>
                        <!-- <button type="button" class="btn btn-danger remove-step">Remove</button> -->
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-primary add-step">Add New Step</button> -->
            <div class="form-group">
                <label for="recipe_image">Recipe Image:</label>
                <a href="../../../images/<?php echo $recipe_row["image"] ?>"> <?php echo $recipe_row["image"] ?> </a>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="recipe_image" name="txtFile">
                    <label class="custom-file-label" for="recipe_image">Choose another file</label>
                </div>
            </div>
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

        if (isset($_FILES['txtFile']) && $_FILES['txtFile']['size'] > 0) {

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
                echo "Success";
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

        if (isset($_FILES['txtFile']) && $_FILES['txtFile']['size'] > 0) {

            // Save data to database 
            $sql = "UPDATE recipes SET user_id = '$user_id', name = '$name', description =  '$description', create_date = '$create_date', preparation_time = '$prep_time',
            cooking_time = '$cook_time', total_time = '$total_time', servings = '$servings', meal_time = '$meal_time', cuisine = '$cuisine', image = '$file_name', status ='$status'
        WHERE recipe_id = '$recipe_id'";
            mysqli_query($con, $sql) or die(mysqli_error($con));
        } else {
            $sql = "UPDATE recipes SET user_id = '$user_id', name = '$name', description =  '$description', create_date = '$create_date', preparation_time = '$prep_time',
            cooking_time = '$cook_time', total_time = '$total_time', servings = '$servings', meal_time = '$meal_time', cuisine = '$cuisine', status ='$status'
        WHERE recipe_id = '$recipe_id'";
            mysqli_query($con, $sql) or die(mysqli_error($con));
        }

        // Get the ID of the newly inserted recipe
        $recipe_id = mysqli_insert_id($con);

        $sql1 = "UPDATE recipes_info SET recipe_id = '$recipe_id', calories = '$calories', carbs = '$carbs',
    fat = '$fat', protein = '$protein'
WHERE recipe_id = '$recipe_id'";
        mysqli_query($con, $sql1) or die(mysqli_error($con));


        $ingredients = $_POST['txtIngredients'];
        $ingredients_array = explode('#', ($ingredients));


        foreach ($ingredients_array as $ingredient) {
            $ingredient = trim($ingredient);
            $ingredient = mysqli_real_escape_string($con, $ingredient);
            $sql = "UPDATE recipes_ingredients SET ingredient = '$ingredient' WHERE recipe_id = '$recipe_id'";
            mysqli_query($con, $sql);
        }



        $steps = $_POST['txtSteps'];
        $steps_array = explode('#', ($steps));

        foreach ($steps_array as $step) {
            $step = trim($step);
            $step = mysqli_real_escape_string($con, $step);
            $sql = "UPDATE recipes_steps SET step = '$step' WHERE recipe_id = '$recipe_id'";
            mysqli_query($con, $sql);
        }
        echo '<script>window.location.href = "../manageRecipes.php";</script>';
        exit;
    }


    ?>

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