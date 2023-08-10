<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../index.php");

include "../../includes/connection.php";

// check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve total number of comments
$sql_comments = "SELECT COUNT(*) AS total_comments FROM feedback";
$result_comments = mysqli_query($con, $sql_comments);
$row_comments = mysqli_fetch_assoc($result_comments);
$total_comments = $row_comments['total_comments'];

// retrieve total number of recipes
$sql_recipes = "SELECT COUNT(*) AS total_recipes FROM recipes";
$result_recipes = mysqli_query($con, $sql_recipes);
$row_recipes = mysqli_fetch_assoc($result_recipes);
$total_recipes = $row_recipes['total_recipes'];

// retrieve total number of users
$sql_users = "SELECT COUNT(*) AS total_users FROM login_users WHERE role = 'user'";
$result_users = mysqli_query($con, $sql_users);
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

// retrieve total number of users
$sql_moderators = "SELECT COUNT(*) AS total_moderator FROM login_users WHERE role = 'moderator'";
$result_moderators = mysqli_query($con, $sql_moderators);
$row_moderators = mysqli_fetch_assoc($result_moderators);
$total_moderators = $row_moderators['total_moderator'];

// close database connection
// mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard page</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <style>
    .circle {
      width: 15px;
      height: 15px;
      border-radius: 50%;
      display: inline-block;
    }

    .circle-primary {
      background-color: #007bff;
    }

    .circle-secondary {
      background-color: #6c757d;
    }
  </style>
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
  <!-- Analytics -->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Comments</h5>
            <canvas id="commentsChart"></canvas>
            <div class="mt-3">
              <div class="d-flex justify-content-between">
                <div class="circle circle-primary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Total Comments</span>";
                echo "<span class='font-weight-bold'>$total_comments</span>";
                ?>
              </div>
              <div class="d-flex justify-content-between">
                <div class="circle circle-secondary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Average Comments Per Recipe</span>";
                echo "<span class='font-weight-bold'></span>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Recipes</h5>
            <canvas id="recipesChart"></canvas>
            <div class="mt-3">
              <div class="d-flex justify-content-between">
                <div class="circle circle-primary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Total Recipes</span>";
                echo "<span class='font-weight-bold'>$total_recipes</span>";
                ?>
              </div>
              <div class="d-flex justify-content-between">
                <div class="circle circle-secondary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Average Ratings Per Recipe</span>";
                echo "<span class='font-weight-bold'></span>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <canvas id="usersChart"></canvas>
            <div class="mt-3">
              <div class="d-flex justify-content-between">
                <div class="circle circle-primary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Total Users</span>";
                echo "<span class='font-weight-bold'>$total_users</span>";
                ?>
              </div>
              <div class="d-flex justify-content-between">
                <div class="circle circle-secondary mr-2"></div>
                <?php
                echo "<span class='text-muted'>New Users This Month</span>";
                echo "<span class='font-weight-bold'></span>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Moderators</h5>
            <canvas id="usersChart"></canvas>
            <div class="mt-3">
              <div class="d-flex justify-content-between">
                <div class="circle circle-primary mr-2"></div>
                <?php
                echo "<span class='text-muted'>Total Users</span>";
                echo "<span class='font-weight-bold'>$total_moderators</span>";
                ?>
              </div>
              <div class="d-flex justify-content-between">
                <div class="circle circle-secondary mr-2"></div>
                <?php
                echo "<span class='text-muted'>New moderators This Month</span>";
                echo "<span class='font-weight-bold'></span>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>
</body>

</html>