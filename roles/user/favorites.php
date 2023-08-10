<?php
session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../index.php");

// include "../../includes/connection.php";

// mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>

    <!-- Custom CSS -->
    <style>
        /* Color scheme 1 */

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

        .hero-section {
            background-image: url('images/h1_hero.png');
            background-size: cover;
            background-position: center center;
            height: 100vh;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/stylesheet.css">
<link rel="stylesheet" href="../../css/search.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="my_account.php">Go Back</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageRecipes.php">My Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorites.php">Favorites</a>
                    </li>
                    <!-- <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="my_account.php"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#recipes">Recipes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cuisines
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=lebanese">Lebanese</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=french">French</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=italian">Italian</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=mexican">Mexican</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=chinese">Chinese</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=indian">Indian</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=german">German</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=greek">Greek</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=japanese">Japanese</a>
                            <a class="dropdown-item" href="recipe_cuisine.php?cuisine=filipino">Filipino</a>
                        </div>
                    </li> -->

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="kitchen_tips.php">Kitchen Tips</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="favorites.php">Favorites</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="picked_for_you.php">Picked For You</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#" id="search-link">Search</a>
                    </li> -->
                    <li class="nav-item">
                        <!-- <button type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2"> -->
                        <a type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2" href="../../includes/logout.php">Logout</a>
                        <!-- </button>   -->
                    </li>
                    <!-- <li class="nav-item">
      <a class="nav-link" href="#">Contact Us</a>
    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- </div>

    </section> -->

    <!-- <div id="search-popup">
        <form action="search.php">
            <input type="text" placeholder="Search...">
            <button type="submit">Go</button>
        </form>
    </div> -->

    <br>
    <div style="text-align: center;">
        <h1><a href="#" style="color: black; text-decoration: none; font-family: 'Playfair Display', serif;">My Favorites</a></h1>
    </div>

    <ul class="cards" id="favorites">
        <div class="row">
            <?php
            include "../../includes/connection.php";

            // Get the user ID
            $user_id = $_SESSION['userId'];

            // Query to get the favorite recipe IDs for the user
            $sql_favorites = "SELECT recipe_id FROM favorites WHERE user_id = '$user_id'";
            $result_favorites = mysqli_query($con, $sql_favorites);

            // Create an array to store the recipe IDs
            $favorite_recipe_ids = array();

            // Loop through the results and add the recipe IDs to the array
            while ($row_favorites = mysqli_fetch_assoc($result_favorites)) {
                $favorite_recipe_ids[] = $row_favorites['recipe_id'];
            }

            // Check if any recipes were found
            if (count($favorite_recipe_ids) > 0) {
                // Query to get the details for the favorite recipes
                $sql_recipes = "SELECT * FROM recipes WHERE recipe_id IN (" . implode(',', $favorite_recipe_ids) . ") AND status='approved'";
                $result_recipes = mysqli_query($con, $sql_recipes);

                // Loop through the results and display the recipe cards
                while ($row_recipes = mysqli_fetch_assoc($result_recipes)) {
                    // Get the data from thedatabase
                    $image = $row_recipes['image'];
                    $title = $row_recipes['name'];
                    $description = $row_recipes['description'];
                    $meal_time = $row_recipes['meal_time'];
                    $recipe_id = $row_recipes['recipe_id'];

                    // Create the card dynamically with the data
                    echo '<div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">';
                    echo '<a href="recipe_details.php?id=' . $recipe_id . '" class="card">';
                    echo '<img src="../../images/' . $image . '" class="card__image" alt="">';
                    echo '<div class="card__overlay">';
                    echo '<div class="card__header">';
                    echo '<svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path></path></svg>';
                    echo '<div class="card__header-text">';
                    echo '<h3 class="card__title">' . $title . '</h3>';
                    echo '<span class="card__status">' . $meal_time . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="card__description">' . $description . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                // Display a message if no favorite recipes were found
                echo '<p>No favorite recipes found.</p>';
            }
            mysqli_close($con);
            ?>
        </div>
    </ul>

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
                        <li><a href="#">Kitchen Tips</a></li>
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

    </script>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>