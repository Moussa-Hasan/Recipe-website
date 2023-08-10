<?php
session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../index.php");

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

        .recipe-image {
            width: 400px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .recipe-description {
            font-size: 20px;
            line-height: 1.5;
        }

        .recipe-info {
            margin-top: 20px;
            font-size: 16px;
            color: #888;
        }

        .recipe-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
        }

        .recipe-box-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .recipe-step {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f2f2f2;
            text-align: center;
            font-size: 20px;
            line-height: 40px;
            margin-right: 10px;
            color: #555;
        }

        .nutrition-box {
            background-color: #f2f2f2;
            padding: 20px;
            margin-bottom: 20px;
            /* width: 45%; */
            display: inline-block;
            vertical-align: top;
        }

        .nutrition-label {
            font-weight: bold;
        }

        .feedback-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            background-color: #f2f2f2;
        }

        .feedback-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
        }

        .feedback-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feedback-item {
            margin-bottom: 40px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }

        .feedback-avatar {
            font-size: 48px;
            color: #ccc;
            margin-right: 20px;
        }

        .feedback-info {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .feedback-rating {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .feedback-rating i.fa-star {
            color: #ffc107;
            font-size: 20px;
        }

        .feedback-rating i.far.fa-star {
            color: #c4c4c4;
            font-size: 20px;
        }

        .feedback-comment {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.5;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .feedback-date {
            font-size: 14px;
            color: #999;
            margin-left: 10px;
        }

        .button-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .button-container button {
            margin-right: 5px;
        }

        .alert {
            margin-top: 10px;
        }

        .close {
            border: none;
            padding: 0;
        }

        .close:focus,
        .close:hover {
            background: transparent;
            color: inherit;
        }

        .close i {
            font-size: 1.2rem;
        }

        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating i:before {
            content: "\f005";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .rating i {
            color: #ddd;
            cursor: pointer;
        }

        .rating i:hover,
        .rating i:hover~i,
        .rating input:checked~i {
            color: #ffca08;
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
                    <!-- <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="my_account.php"><?php echo $_SESSION['user']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Recipes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cuisines
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item" href="#" disabled>All Cuisines</a> -->
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
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kitchen_tips.php">Kitchen Tips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="picked_for_you.php">Picked For You</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="favorites.php">Favorites</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="search-link">Search</a>
                    </li>
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

    <div id="search-popup">
        <form action="search.php">
            <input type="text" placeholder="Search...">
            <button type="submit">Go</button>
        </form>
    </div>

    <!-- Main content end -->

    <?php
    include '../../includes/connection.php';
    if (isset($_GET)) {

        $recipe_id = $_GET['id'];

        $sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
        $result = mysqli_query($con, $sql);
        $recipe = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM recipes_ingredients WHERE recipe_id = $recipe_id AND ingredient IS NOT NULL AND ingredient <> ''";
        $result = mysqli_query($con, $sql);
        $ingredients = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql = "SELECT * FROM recipes_steps WHERE recipe_id = $recipe_id AND step IS NOT NULL AND step <> ''";
        $result_step = mysqli_query($con, $sql);
        $steps = mysqli_fetch_all($result_step, MYSQLI_ASSOC);

        $sql = "SELECT * FROM recipes_info WHERE recipe_id = $recipe_id";
        $result_info = mysqli_query($con, $sql);
        $info = mysqli_fetch_assoc($result_info);

        $sql = "SELECT * FROM feedback WHERE recipe_id = $recipe_id";
        $result_feedback = mysqli_query($con, $sql);
        $feedbacks = mysqli_fetch_all($result_feedback, MYSQLI_ASSOC);
    }

    $user_id = $recipe['user_id'];
    $sql = "SELECT first_name FROM login_users WHERE user_id = $user_id";
    $result_users = mysqli_query($con, $sql);
    $users = mysqli_fetch_assoc($result_users);

    $email = $_SESSION['EmailUser'];
    $sql = "SELECT user_id FROM login_users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);
    $user_ids = $user['user_id'];

    mysqli_close($con);
    ?>
    <div class="container">
        <h1><?php echo $recipe['name']; ?></h1>
        <!-- <h3>Description:</h3> -->
        <p class="recipe-description"><?php echo $recipe['description']; ?></p>
        <div class="recipe-actions">
            <div class="button-container">
                <button class="btn btn-outline-primary" onclick="copyRecipeLink()">Share</button>
                <form method="post">
                    <button type="submit" name="add-to-favorites" value="true" class="btn btn-outline-danger">
                        <?php if (isRecipeInFavorites($recipe_id, $user_ids)) : ?>
                            <i class="fas fa-heartbeat"></i>
                        <?php else : ?>
                            <i class="fas fa-heart"></i>
                        <?php endif; ?>
                    </button>
                </form>
            </div>
        </div>

        <?php
        // Function to check if the recipe is in the user's favorites
        function isRecipeInFavorites($recipe_id, $user_ids)
        {
            include '../../includes/connection.php';
            $sql = "SELECT * FROM favorites WHERE recipe_id = $recipe_id AND user_id = $user_ids";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                return true;
            } else {
                return false;
            }
            mysqli_close($con);
        }

        // Handle adding the recipe to favorites
        if (isset($_POST['add-to-favorites'])) {
            include '../../includes/connection.php';
            $sql = "SELECT * FROM favorites WHERE recipe_id = $recipe_id AND user_id = $user_ids";
            $result = mysqli_query($con, $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows == 0) {
                $sql = "INSERT INTO favorites (recipe_id, user_id) VALUES ($recipe_id, $user_ids)";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<script> 
                        var heartIcon = document.querySelector(".recipe-actions button i");
                        heartIcon.classList.remove("fa-heart");
                        heartIcon.classList.add("fa-heartbeat");
                        var toast = document.getElementById("notification-toast");
                        var toastBody = toast.querySelector(".toast-body");
                        toastBody.textContent = "Recipe added to favorites!";
                        var bsToast = new bootstrap.Toast(toast);
                        bsToast.show();
                    </script>';
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" data-bs-delay="4000">
                        Recipe added to the favorites.
                        <button type="button" class="close float-end text-white bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to add recipe to favorites.
                            <button type="button" class="close float-end text-white bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                          </div>';
                }
            } else {
                // Delete the recipe from the favorites table
                $sql_delete_favorite = "DELETE FROM favorites WHERE user_id = '$user_ids' AND recipe_id = '$recipe_id'";
                $result_delete_favorite = mysqli_query($con, $sql_delete_favorite);

                // Check if the deletion was successful
                if ($result_delete_favorite) {
                    // Change the heart icon back to its default state
                    echo '<script> 
                        var heartIcon = document.querySelector(".recipe-actions button i");
                        heartIcon.classList.remove("fa-heartbeat");
                        heartIcon.classList.add("fa-heart");
                    </script>';

                    // Display a success message
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Recipe removed from favorites.
                        <button type="button" class="close float-end text-white bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>';
                } else {
                    // Display an error message
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to remove recipe from favorites.
                        <button type="button" class="close float-end text-white bg-transparent" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>';
                }
            }
            mysqli_close($con);
        }
        ?><br>
        <img src="../../images/<?php echo $recipe['image']; ?>" alt="<?php echo $recipe['name']; ?>" class="img-fluid recipe-image">
        <p class="recipe-info">Recipe by <?php echo $users['first_name']; ?> | Updated on <?php echo $recipe['create_date']; ?></p>
        <div class="recipe-box">
            <h2 class="recipe-box-header">Recipe Information</h2>
            <p><strong>Preparation Time:</strong> <?php echo $recipe['preparation_time']; ?> mins</p>
            <p><strong>Cooking Time:</strong> <?php echo $recipe['cooking_time']; ?> mins</p>
            <p><strong>Total Time:</strong> <?php echo $recipe['total_time']; ?> mins</p>
            <p><strong>Servings:</strong> <?php echo $recipe['servings']; ?></p>
        </div>

        <div class="recipe-box">
            <h2 class="recipe-box-header">Ingredients</h2>
            <ul>
                <?php foreach ($ingredients as $ingredient) : ?>
                    <li><?php echo $ingredient['ingredient']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div><br>

        <h2 class="recipe-box-header">Steps</h2>
        <ol style="list-style-type: none; padding-left: 0;">
            <?php $step_num = 1; ?>
            <?php foreach ($steps as $step) : ?>
                <li>
                    <div class="recipe-step"><?php echo $step_num; ?></div>
                    <div><?php echo $step['step']; ?></div>
                </li>
                <?php $step_num++; ?>
            <?php endforeach; ?>
        </ol><br>

        <div class="nutrition-box">
            <h2>Nutrition Facts (per serving)</h2>
            <table class="nutrition-table">
                <tr>
                    <td class="nutrition-label">Calories:</td>
                    <td><?php echo $info['calories']; ?></td>
                    <td>&nbsp;</td>
                    <td class="nutrition-label">Fat:</td>
                    <td><?php echo $info['fat']; ?>g</td>
                    <td>&nbsp;</td>
                    <td class="nutrition-label">Carbs:</td>
                    <td><?php echo $info['carbs']; ?>g</td>
                    <td>&nbsp;</td>
                    <td class="nutrition-label">Protein:</td>
                    <td><?php echo $info['protein']; ?>g</td>
                </tr>
            </table>
        </div>
        <!-- Display the existing reviews -->
        <div class="feedback-box">
            <h2 class="feedback-header">Reviews</h2>
            <?php if (empty($feedbacks)) : ?>
                <p>No reviews yet.</p>
            <?php else : ?>
                <ul class="feedback-list" id="feedback">
                    <?php foreach ($feedbacks as $feedback) : ?>
                        <li class="feedback-item">
                            <div class="feedback-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="feedback-info">
                                    <?php include '../../includes/connection.php';
                                    $user_id = $feedback['user_id'];
                                    $sql_user = "SELECT first_name FROM login_users WHERE user_id = $user_id";
                                    $result_user = mysqli_query($con, $sql_user);
                                    $user = mysqli_fetch_assoc($result_user);
                                    echo $user['first_name'];
                                    mysqli_close($con);
                                    ?>
                                </div>
                                <div class="feedback-rating">
                                    <?php for ($i = 1; $i <= $feedback['rate']; $i++) : ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php endfor; ?>
                                    <?php for ($i = $feedback['rate'] + 1; $i <= 5; $i++) : ?>
                                        <i class="far fa-star text-warning"></i>
                                    <?php endfor; ?>
                                    <span class="feedback-date"><?php echo date('M d, Y', strtotime($feedback['create_date'])); ?></span>
                                </div>
                                <div class="feedback-comment"><?php echo $feedback['review']; ?></div>
                                <?php if ($user_ids == $feedback['user_id']) : ?>
                                    <div class="feedback-actions">
                                        <form method="post" action="actions/review_delete.php">
                                            <input type="hidden" name="feedback_id" value="<?php echo $feedback['feedback_id']; ?>">
                                            <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
                                            <button type="submit" name="delete_feedback" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div><br>

        <!-- Display the review form -->
        <div class="review-form-box">
            <h2 class="review-form-header">Leave a Review</h2>
            <form method="post" action="actions/review_submit.php">
                <div class="form-group">
                    <div id="rating" class="rating">
                        <input type="radio" name="rating" value="1" id="rating-1" required>
                        <label for="rating-1"><i class="far fa-star"></i></label>
                        <input type="radio" name="rating" value="2" id="rating-2" required>
                        <label for="rating-2"><i class="far fa-star"></i></label>
                        <input type="radio" name="rating" value="3" id="rating-3" required>
                        <label for="rating-3"><i class="far fa-star"></i></label>
                        <input type="radio" name="rating" value="4" id="rating-4" required>
                        <label for="rating-4"><i class="far fa-star"></i></label>
                        <input type="radio" name="rating" value="5" id="rating-5" required>
                        <label for="rating-5"><i class="far fa-star"></i></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_ids; ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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

    <script>
        // Function to copy the recipe link to the clipboard
        function copyRecipeLink() {
            var recipeLink = window.location.href;
            navigator.clipboard.writeText(recipeLink);
            alert('Recipe link copied to clipboard!');
        }

        // Function to add the recipe to favorites
        function addRecipeToFavorites(recipeId) {
            // Check if the user is logged in
            <?php if (isset($_SESSION['EmailUser'])) : ?>
                // Send an AJAX request to add the recipe to favorites
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.success) {
                            // Update the heart icon to be full red
                            var heartIcon = document.querySelector('.recipe-actions button i');
                            heartIcon.classList.remove('fa-heart');
                            heartIcon.classList.add('fa-heartbeat');
                        }
                    }
                };
                xhr.open("POST", "add_recipe_to_favorites.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("recipe_id=" + recipeId);

            <?php else : ?>
                // Prompt the user to log in
                alert('You must be logged in to add recipes to your favorites.');
            <?php endif; ?>
        }
        // Generate a random profile picture for each comment using Font Awesome
        var avatars = document.querySelectorAll('.feedback-avatar i');
        var icons = ['user-circle'];
        for (var i = 0; i < avatars.length; i++) {
            var icon = icons[Math.floor(Math.random() * icons.length)];
            avatars[i].classList.add('fa-' + icon);
        }

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

        // Get the "View Recipes" link
        const recipesLink = document.querySelector('a[href="#recipes"]');

        // Add a click event listener to the link
        recipesLink.addEventListener('click', function(event) {
            // Prevent the default link behavior
            event.preventDefault();

            // Get the target element (the recipe section)
            const target = document.querySelector('#recipes');

            // Calculate the distance from the top of the page to the target element
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;

            // Scroll smoothly to the target element
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });

        $(document).ready(function() {
            $('.rating input').click(function() {
                var rating = $(this).val();
                $('.rating label i').removeClass('fas').addClass('far');
                for (var i = 1; i <= rating; i++) {
                    $('.rating label:nth-child(' + i + ') i').removeClass('far').addClass('fas');
                }
            });
        });
    </script>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>