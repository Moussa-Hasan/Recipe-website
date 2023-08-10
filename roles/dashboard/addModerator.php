<?php

session_start();

include "../../includes/connection.php";

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../index.php");

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
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Add Moderator</h5>
            <br>
            <form action="actions/moderator_adding.php" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="txtFname" class="form-control" id="firstName" placeholder="Enter first name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="txtLname" class="form-control" id="lastName" placeholder="Enter last name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="txtEmail" class="form-control" id="email" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="txtPassword" class="form-control" id="password" placeholder="Enter password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="txtBdate" class="form-control" id="dob">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="txtPhone" class="form-control" id="phone" placeholder="Enter phone number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="txtGender" class="form-control" id="gender">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Add Moderator</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>

  <script>

  </script>
</body>

</html>