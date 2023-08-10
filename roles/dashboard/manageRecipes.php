<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
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

    <!-- manage recipe -->
    <br>
    <div class="container">
        <h1>Manage Recipes</h1>
        <br>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="status-filter">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" id="filter-btn">Filter</button>
                </div>
            </div>
        <br>
        <?php

        // Establish a database connection
        include "../../includes/connection.php";

        // Select all data from the recipes table
        $status_filter = '';
        if (isset($_GET['status'])) {
            $status_filter = "WHERE status = '" . mysqli_real_escape_string($con, $_GET['status']) . "'";
        }
        $sql = "SELECT * FROM recipes $status_filter";
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
        // echo '<th>Date Created</th>';
        echo '<th>Meal Time</th>';
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
            echo "</td>";
            echo "<td>";
            echo '<a href="#" data-toggle="modal" data-target="#recipeModal' . $row["recipe_id"] . '"><img src="../../images/info.png" alt="read-more" width="35" height="35"></a></p>';
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