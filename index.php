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

  // $qry3 = "SELECT first_name FROM login_users WHERE email = '$email'";
  // $result3 = mysqli_query($con, $qry3);
  // $row3 = mysqli_fetch_array($result3);
  // $first_name = $row3['first_name'];

  // $_SESSION['first_name'] = $first_name;


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
  <title>Index page</title>

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

    .hero-section {
      position: relative;
    }

    /* .animated-title {
      position: absolute;
      top: 40%;
      left: 2%;
      transform: translateY(-50%);
      animation: slideInLeft 1s forwards;
      animation-fill-mode: forwards;
      opacity: 0;
      max-width: 50%;
      white-space: normal;
    }

    @keyframes slideInLeft {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }

      100% {
        transform: translateX(0);
        opacity: 1;
      }
    } */
  </style>
</head>

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-lfZjXTLJc99TgTkgR0m0BcCcYK2KW6UzL6nE8+FGNLV6eQ3bsGLmkNT7JF8a+u+bMwvhjKk+/HY7zg5Z5W5H5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <section class="hero-section">
      <div class="hero-content">

        <!-- <h1 class="animated-title">Good food has the power to create genuine smiles and lasting memories.</h1> -->

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
                  <a class="nav-link" href="#featurette">About Us</a>
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

        <!-- <h1>Welcome to My Website</h1>
    <p>Here you'll find all kinds of great content.</p> -->
      </div>

    </section>

    <!-- <div id="search-popup">
      <form action="search.php">
        <input type="text" placeholder="Search...">
        <button type="submit">Go</button>
      </form>
    </div> -->

    <!-- Cards -->

    <div style="text-align: center;">
      <h1><a href="#" style="color: black; text-decoration: none; font-family: 'Playfair Display', serif;">What's New</a></h1>
    </div>


    <ul class="cards" id="recipes">
      <div class="row">
        <?php
        // Query to fetch data from the database
        $sql = "SELECT * FROM recipes WHERE status = 'approved'";
        $result = mysqli_query($con, $sql);

        // Loop through the query result and create cards dynamically
        $card_count = 0;

        $recipe_count = mysqli_num_rows($result);
        if ($recipe_count > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            // Get the data from the database
            $image = $row['image'];
            $title = $row['name'];
            $description = $row['description'];
            $meal_time = $row['meal_time'];
            $recipe_id = $row['recipe_id'];

            // Create the card dynamically with the data
            echo '<div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">';
            echo '<a href="recipe_details.php?id=' . $recipe_id . '" class="card">';
            echo '<img src="images/' . $image . '" class="card__image" alt="">';
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

            // Increment the card count and exit the loop if the maximum count is reached
            $card_count++;
            if ($card_count >= 6) {
              break;
            }
          }
        } else {
          echo "No data found.";
        }
        ?>
      </div>
    </ul>
    <br>

    <!--? Our Services Start -->
    <!-- <div class="our-services section-padding30">
      <div class="container">
        <div class="row justify-content-sm-center">
          <div class="cl-xl-7 col-lg-8 col-md-10">
            <div class="section-tittle text-center mb-70">
              <span>Servicees We Offer</span>
              <h2>Our Best Services</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-lg-4 col-md-6 col-sm-6">
            <div class="single-services text-center mb-30">
              <div class="services-ion">
                <span class="fas fa-hat-chef"></span>
              </div>
              <div class="services-cap">
                <h5><a href="#">Best Chef</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
              </div>
            </div>
          </div>
          <div class=" col-lg-4 col-md-6 col-sm-6">
            <div class="single-services active text-center mb-30">
              <div class="services-ion">
                <span class="flaticon-tools-and-utensils-1"></span>
              </div>
              <div class="services-cap">
                <h5><a href="#">Quality Food</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
              </div>
            </div>
          </div>
          <div class=" col-lg-4 col-md-6 col-sm-6">
            <div class="single-services text-center mb-30">
              <div class="services-ion">
                <span class="flaticon-restaurant"></span>
              </div>
              <div class="services-cap">
                <h5><a href="#">Perfect Cook</a></h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Our Services End -->

    <br>

    <!-- featurette -->
    <div class="container" id="featurette">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Find Your Next Favorite Recipe. <span class="text-muted">Explore a wide variety of dishes.</span></h2><br>
          <p class="lead">Our website features thousands of recipes from around the world, spanning every type of cuisine and dietary preference. Whether you're in the mood for something sweet or savory, vegetarian or meat-based, we've got you covered.</p>
        </div>
        <div class="col-md-5">
          <img src="images/food 3.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Food">
        </div>
      </div>
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fw-normal lh-1">Save and Organize Your Favorite Recipes. <span class="text-muted">Keep track of what you love.</span></h2><br>
          <p class="lead">With our built-in recipe box, you can easily save and organize all your favorite recipes in one place. Say goodbye to bookmarking a million different recipe websites.</p> <!-- You can also create custom folders and tags to make finding recipes even easier. -->
        </div>
        <div class="col-md-5 order-md-1">
          <img src="images/recipe-box.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Recipe Box">
        </div>
      </div>
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Get Cooking Tips and Techniques. <span class="text-muted">Learn new skills in the kitchen.</span></h2><br>
          <p class="lead">Our website also features a wealth of cooking tips and techniques to help you improve your skills in the kitchen. From knife skills to baking tricks, we've got everything you need to become a better home cook.</p>
        </div>
        <div class="col-md-5">
          <img src="images/cooking-tips.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Cooking Tips">
        </div>
      </div>
      <hr class="featurette-divider">
    </div>

    <!-- <br> -->

    <!-- featurette -->

    <!-- <div class="container">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Delicious Chocolate Cake. <span class="text-muted">It'll satisfy your sweet tooth.</span></h2>
          <p class="lead">This cake is a chocolate lover's dream come true. Moist, rich, and decadent, it's the perfect dessert for any occasion. With a simple recipe and easy-to-follow instructions, you'll have this cake on your table in no time.</p>
        </div>
        <div class="col-md-5">
          <img src="images/chocolate cake.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Chocolate Cake">
        </div>
      </div>
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fw-normal lh-1">Creamy Garlic Shrimp Pasta. <span class="text-muted">Perfect for date night.</span></h2>
          <p class="lead">If you're looking for a fancy, restaurant-quality meal to impress your significant other, look no further. This creamy garlic shrimp pasta is sure to please. With plump shrimp, al dente pasta, and a rich sauce, it's a dish you won't forget.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <img src="images/shrimp pasta.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Shrimp Pasta">
        </div>
      </div>
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Fluffy Buttermilk Pancakes. <span class="text-muted">Start your day off right.</span></h2>
          <p class="lead">There's nothing like a stack of fluffy, golden pancakes to kick off your morning. These buttermilk pancakes are light, airy, and oh-so-delicious. Top them with your favorite syrup and some fresh fruit for a breakfast that's sure to please.</p>
        </div>
        <div class="col-md-5">
          <img src="images/buttermilk pancake.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" alt="Buttermilk Pancakes">
        </div>
      </div>
      <hr class="featurette-divider">
    </div> -->


    <br>

    <!-- Main content end -->

    <!-- Footer begin -->
    <footer class="footer bg-light">
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

      // Get the "Featurette" link
      const featuretteLink = document.querySelector('a[href="#featurette"]');

      // Add a click event listener to the link
      featuretteLink.addEventListener('click', function(event) {
        // Prevent the default link behavior
        event.preventDefault();

        // Get the target element (the featurette)
        const target = document.querySelector('#featurette');

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

      //search

      function search() {
        var query = document.getElementById("search-input").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "search.php?q=" + query, true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            var results = JSON.parse(xhr.responseText);
            updateSuggestions(results);
          }
        };
        xhr.send();
      }

      function updateSuggestions(results) {
        var html = '';
        results.forEach(result => {
          html += '<div class="suggestion">' + result.name + '</div>';
        });
        document.getElementById("suggestions").innerHTML = html;
      }
    </script>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>