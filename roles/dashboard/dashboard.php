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
$sql_users = "SELECT COUNT(*) AS total_users FROM login_users WHERE role='user'";
$result_users = mysqli_query($con, $sql_users);
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

// retrieve total number of moderator
$sql_moderators = "SELECT COUNT(*) AS total_moderators FROM login_users WHERE role='moderator'";
$result_moderators = mysqli_query($con, $sql_moderators);
$row_moderators = mysqli_fetch_assoc($result_moderators);
$total_moderators = $row_moderators['total_moderators'];

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
          <a class="nav-link" href="#">Dashboard</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="addRecipes.php">Add Recipe</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addModerator.php">Add Moderator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageRecipes.php">Manage Recipes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageUsers.php">Manage Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageCmnts.php">Comments and Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="analytics.php">Analytics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../includes/logout.php">Sign out</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Page Content -->

  <!-- state -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recipes</h5>
            <?php
            echo "<p class='card-text'>$total_recipes</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <?php
            echo "<p class='card-text'>$total_users</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Comments</h5>
            <?php
            echo "<p class='card-text'>$total_comments</p>";
            ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Moderator</h5>
            <?php
            echo "<p class='card-text'>$total_moderators</p>";
            ?>
          </div>
        </div>
      </div>
    </div>
    <br>

    <!--  -->

    <script src="../../js/popper.min.js"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
</body>

</html>