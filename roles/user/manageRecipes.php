<?php

session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../index.php");

// Establish a database connection
include "../../includes/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['recipe_id'])) {

        $recipe_id = $_POST["recipe_id"];

        $sql = "DELETE FROM recipes WHERE recipe_id = '$recipe_id'";

        if (mysqli_query($con, $sql)) {
            echo "Recipe deleted successfully";
        } else {
            echo "Error deleting recipe: " . mysqli_error($con);
        }

        // Close database connection
        mysqli_close($con);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/edited_stylesheet.css">
    <link rel="stylesheet" href="../../css/search.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.4.0-web/css/all.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            /* background-color: #F8EDE3; */
            background-color: #f8f9f9;
        }

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
                        <a class="nav-link" href="manageRecipes.php">My Recipes</a>
                    </li> -->
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

    <!-- <div id="search-popup">
        <form action="search.php">
            <input type="text" placeholder="Search...">
            <button type="submit">Go</button>
        </form>
    </div> -->

    <!-- Page Content -->

    <!-- manage recipe -->
    <br>
    <div class="container">
        <h2 style="text-align: center; font-family: 'Playfair Display', serif;">Manage my recipes</h2><br>
        <br>
        <?php

        // Establish a database connection
        include "../../includes/connection.php";

        $id = $_SESSION['userId'];
        $sql = "SELECT * FROM recipes WHERE user_id='$id'";
        $result = mysqli_query($con, $sql);

        // Display the results in a table
        echo '<div class="content">';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Recipe Id</th>';
        echo '<th>Recipe Name</th>';
        echo '<th>Meal Time</th>';
        // echo '<th>Date Created</th>';
        echo '<th>Cuisine</th>';
        echo '<th>Status</th>';
        echo '<th>Action</th>';
        echo '<th></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {

            // Fetch the name of the user who submitted the recipe
            $user_sql = "SELECT first_name, last_name, user_id FROM login_users WHERE user_id = '" . $row["user_id"] . "'";
            $user_result = mysqli_query($con, $user_sql);
            $user_row = mysqli_fetch_assoc($user_result);

            // Fetch the info
            $info_sql = "SELECT * FROM recipes_info WHERE recipe_id = '" . $row["recipe_id"] . "'";
            $info_result = mysqli_query($con, $info_sql);
            $info_row = mysqli_fetch_assoc($info_result);

            echo '<tr>';
            echo '<td>' . $row['recipe_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            // echo '<td>' . $row['create_date'] . '</td>';
            echo '<td>' . $row['meal_time'] . '</td>';
            echo '<td>' . $row['cuisine'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo "<td>";
            echo '<a href="actions/edit_recipe.php?recipe_id=' . $row['recipe_id'] . '"><img src="../../images/edit.png" width="30" height="30" alt="Edit"></a>';
            echo '<a href="#" class="ml-2" data-toggle="modal" data-target="#deleteRecipeModal" data-id="' . $row['recipe_id'] . '"><img src="../../images/delete.png" alt="Delete" width="30" height="30"></a>';
            // echo '<a href="actions/edit_recipe.php?recipe_id=' . $row['recipe_id'] . '" class="btn btn-primary">Edit</a>';
            // echo '<a href="#" class="btn btn-danger ml-2" data-toggle="modal" data-target="#deleteRecipeModal" data-id="' . $row['recipe_id'] . '">Delete</a>';
            echo "</td>";
            echo "<td>";
            echo '<a href="#" data-toggle="modal" data-target="#recipeModal' . $row["recipe_id"] . '"><img src="../../images/info.png" alt="read-more" width="35" height="35"></a></p>';
            // echo '<a href="#" data-toggle="modal" data-target="#recipeModal' . $row["recipe_id"] . '">See More</a></p>';
            echo "</td>";
            echo '</tr>';

            // Recipe Modal
            echo '<div class="modal fade" id="recipeModal' . $row["recipe_id"] . '" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel' . $row["recipe_id"] . '" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="recipeModalLabel' . $row["recipe_id"] . '">' . $row["name"] . '</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<div class="row">';
            echo '<div class="col-md-7">';
            echo '<img src="../../images/' . nl2br($row["image"]) . '" class="img-fluid rounded" alt="">';
            echo '</div>';
            echo '<div class="col-md-5">';
            echo '<ul class="list-group list-group-flush">';
            echo '<li class="list-group-item"><strong>Preparation Time: </strong><br> ' . nl2br($row["preparation_time"]) . ' min</li>';
            echo '<li class="list-group-item"><strong>Cooking Time: </strong><br> ' . nl2br($row["cooking_time"]) . ' min</li>';
            echo '<li class="list-group-item"><strong>Servings: </strong><br> ' . nl2br($row["servings"]) . ' persons</li>';
            echo '<li class="list-group-item"><strong>Date Created:</strong><br>' . nl2br($row["create_date"])  . '</li>';
            echo '</ul>';
            echo '</div>';
            echo '<div class="mx-3">';
            echo '<strong>Description:</strong>';
            echo '<p class="mb-2">' . $row["description"] . '</p>';
            echo '<strong>Nutritional Information:</strong>';
            echo '<p><i>Calories:</i> <b>' . ($info_row['calories'] . '</b> | <i>Fats:</i> <b>' . $info_row['fat'] . '</b> <i>g</i> | <i>Proteins</i> <b>' . $info_row['protein'] . '</b> <i>g</i> | <i>Carbs:</i> <b>' . $info_row['carbs']) . '</b> <i>g</i></p>';
            echo '<strong>Submitted By:</strong>';
            echo '<p class="mb-2">' . nl2br($user_row["first_name"] . ' ' . $user_row["last_name"]) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';



        // Close the database connection
        mysqli_close($con);
        ?>

    </div>


    <!-- Delete Recipe Modal -->
    <div class="modal fade" id="deleteRecipeModal" tabindex="-1" role="dialog" aria-labelledby="deleteRecipeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRecipeModalLabel">Delete Recipe?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this recipe?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteRecipe()">Delete</button>
                </div>
            </div>
        </div>
    </div>

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
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/bootstrap.js"></script>

    <script>
        function deleteRecipe() {
            var recipe_id = $('#deleteRecipeModal').data('id');
            $.ajax({
                url: '',
                type: 'post',
                data: {
                    recipe_id: recipe_id
                },
                success: function(response) {
                    // Refresh the page after successful deletion
                    location.reload();
                }
            });
        }

        $('#deleteRecipeModal').on('show.bs.modal', function(e) {
            var recipe_id = $(e.relatedTarget).data('id');
            $(this).data('id', recipe_id);
        });

        document.getElementById('filter-btn').addEventListener('click', function() {
            var status = document.getElementById('status-filter').value;
            var url = window.location.href.split('?')[0];
            if (status) {
                url += '?status=' + status;
            }
            window.location.href = url;
        });
    </script>
</body>

</html>