<?php
session_start();
include 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    $qry = "SELECT * FROM login_users WHERE password = '$password' AND email = '$email'";

    $result = mysqli_query($con, $qry);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    $qry1 = "SELECT first_name FROM login_users WHERE email = '$email'";

    $result1 = mysqli_query($con, $qry1);
    $row1 = mysqli_fetch_array($result1);
    $count1 = mysqli_num_rows($result1);

    if ($count1 == 1) {
        $username = $row1['first_name'];
        $_SESSION['user'] = $username;
    }

    $qry2 = "SELECT user_id FROM login_users WHERE email = '$email'";

    $result2 = mysqli_query($con, $qry2);
    $row2 = mysqli_fetch_array($result2);
    $count2 = mysqli_num_rows($result2);

    if ($count2 == 1) {
        $user_id = $row2['user_id'];
    }

    if ($count == 1) {

        if ($row['role'] == "admin") {

            $_SESSION['EmailAdmin'] = $email;
            $_SESSION['adminId'] = $user_id;
            header("location:../test-3/roles/dashboard/dashboard.php");
        } else if ($row['role'] == "user") {

            $_SESSION['EmailUser'] = $email;
            $_SESSION['userId'] = $user_id;
            header("location:../test-3/roles/user/welcome.php");
        } else if ($row['role'] == "moderator") {

            $_SESSION['EmailModerator'] = $email;
            $_SESSION['moderatorId'] = $user_id;
            header("location:../test-3/roles/moderator/moderator.php");
        }
    } else
        // header("location:index.php?error=1");
        echo "<script>alert('incorrect password or email');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuisines page</title>

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

        .band {
            width: 90%;
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: auto;
            grid-gap: 20px;
        }

        @media (min-width: 30em) {
            .band {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (min-width: 60em) {
            .band {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .card {
            background: white;
            text-decoration: none;
            color: #444;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            min-height: 100%;
            position: relative;
            top: 0;
            transition: all 0.1s ease-in;
        }

        .card:hover {
            top: -2px;
            box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);
        }

        .card article {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card h1 {
            font-size: 20px;
            margin: 0;
            color: #333;
        }

        .card p {
            flex: 1;
            line-height: 1.4;
        }

        .card span {
            font-size: 12px;
            font-weight: bold;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 2em 0 0 0;
        }

        .card .thumb {
            padding-bottom: 60%;
            background-size: cover;
            background-position: center center;
        }

        @media (min-width: 60em) {
            .item-1 {
                grid-column: 1/span 2;
            }

            .item-1 h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">

<body>
    <!-- login form -->
    <div>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>Login</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <input type="email" name="txtEmail" class="form-control" id="email1" placeholder="Your email address..." required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="txtPassword" class="form-control" id="password1" placeholder="Your password..." required>
                                </div>
                                <button type="submit" class="btn btn-success btn-block btn-round">Login</button>
                            </form>

                            <!-- <div class="text-center text-muted delimiter">or use a social network</div>
              <div class="d-flex justify-content-center social-buttons">
                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                  <i class="fab fa-twitter"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                  <i class="fab fa-facebook"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                  <i class="fab fa-linkedin"></i>
                </button>
            </div>
          </div> -->
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <div class="signup-section">Not a member yet? <a href="includes/signup.php" class="text-success"> Sign Up</a>.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content begin -->

        <!-- <section class="hero-section">
      <div class="hero-content"> -->

        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="index.php"> <img src="images/logo.png" alt="Logo" width="52" height="52" style="margin-right: 10px;">
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
                            <a class="nav-link" href="#recipes">Recipes</a>
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
                            <a class="nav-link" href="#footer">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search.php">Search</a>
                        </li>
                        <!-- <li class="nav-item">
      <a class="nav-link" href="#">Contact Us</a>
    </li> -->
                        <li class="nav-item">
                            <button type="button" class="btn btn-outline-secondary btn-round mr-md-3 mb-md-0 mb-2" data-toggle="modal" data-target="#loginModal">
                                Login
                            </button>
                        </li>
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

        <div class="band">
            <div class="item-1">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/sharp_knive.jpg);"></div>
                    <article>
                        <h1>How to Keep Your Knives Sharp</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Knife Maintenance</div>
                    </article>
                </a>
            </div>
            <div class="item-2">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/secret_ingredients.jpg);"></div>
                    <article>
                        <h1>10 Secret Ingredients for Delicious Food</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Cooking Tips</div>
                    </article>
                </a>
            </div>
            <div class="item-3">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/organize_kitchen.jpg);"></div>
                    <article>
                        <h1>How to Organize Your Kitchen Like a Pro</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Kitchen Organization</div>
                    </article>
                </a>
            </div>
            <div class="item-4">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/rice.jpg);"></div>
                    <article>
                        <h1>How to Cook Perfect Rice Every Time</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Rice Cooking</div>
                    </article>
                </a>
            </div>
            <div class="item-5">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/tools.jpg);"></div>
                    <article>
                        <h1>5 Kitchen Gadgets That Will Save You Time and Effort</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Kitchen Gadgets</div>
                    </article>
                </a>
            </div>
            <div class="item-6">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/pasta.jpg);"></div>
                    <article>
                        <h1>How to Make Homemade Pasta from Scratch</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Pasta Making</div>
                    </article>
                </a>
            </div>
            <div class="item-7">
                <a href="#" class="card">
                    <div class="thumb" style="background-image: url(images/kitchen_cleaning.jpg);"></div>
                    <article>
                        <h1>How to Clean Your Kitchen Appliances</h1>
                        <span>by Taste Trail</span>
                        <div class="tag">Appliance Cleaning</div>
                    </article>
                </a>
            </div>
        </div>


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
        </script>

        <script src="js/popper.min.js"></script>
        <script src="js/jquery-3.6.3.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>