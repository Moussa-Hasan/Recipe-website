<?php

session_start();

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstName = $_POST['txtFname'];
  $lastName = $_POST['txtLname'];
  $email = $_POST['txtEmail'];
  $phone = $_POST['txtPhone'];
  $date = $_POST['txtBdate'];
  $password = $_POST['txtPassword'];
  $gender = $_POST['txtGender'];
  $preference = $_POST['txtPreference'];
  // $userRole = $_POST['txtRole1'];
  $user = "user";

  // Calculate the age of the user based on the date of birth
  $age = date_diff(date_create($date), date_create('today'))->y;

  $qry = "SELECT * FROM login_users WHERE email = '$email'";
  $result = mysqli_query($con, $qry);
  $count = mysqli_num_rows($result);

  // query to retrive user name to display it
  // $qry1 = "SELECT first_name FROM login_users WHERE email = '$email'";
  // $result1 = mysqli_query($con,$qry1);
  // $row1=mysqli_fetch_array($result1);
  // $name = $row1['first_name'];

  if ($count > 0)
    echo "<script>alert('User already exist');</script>";

  else {

    // $_SESSION['user'] = $name;
    $_SESSION['EmailUser'] = $email;

    // Validate first name field
    if (empty($firstName)) {
      $errors[] = "First name is required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
      $errors[] = "Only letters and white space allowed in first name";
    }

    // Validate last name field
    if (empty($lastName)) {
      $errors[] = "Last name is required";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
      $errors[] = "Only letters and white space allowed in last name";
    }

    // Validate birthday field
    if (empty($date)) {
      $errors[] = "Birthday is required";
    } else if ($age < 16) {
      $errors[] = "You must be 16 years old or older to register.";
    }

    // Validate email field
    if (empty($email)) {
      $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format";
    }

    // Validate phone field
    if (empty($phone)) {
      $errors[] = "Phone number is required";
    } else if (!preg_match("/^[0-9]+$/", $phone)) {
      $errors[] = "Only numbers allowed in phone number";
    }

    // Validate password field
    if (empty($password)) {
      $errors[] = "Password is required";
    }

    // If there are no errors, save the data to database 
    if (empty($errors)) {

      // Save data to database 
      $sql = "INSERT INTO login_users (first_name, last_name, email,  password, phone, date, role, gender, preferences)
        VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$date', '$user', '$gender', '$preference')";
      mysqli_query($con, $sql) or die(mysqli_error($con));

      $qry1 = "SELECT first_name FROM login_users WHERE email = '$email'";

      $result1 = mysqli_query($con, $qry1);
      $row1 = mysqli_fetch_array($result1);
      $count1 = mysqli_num_rows($result1);

      $username = $row1['first_name'];
      $_SESSION['user'] = $username;
      $id = $_SESSION['userId'];

      $qry2 = "SELECT user_id FROM login_users WHERE email = '$email'";

      $result2 = mysqli_query($con, $qry2);
      $row2 = mysqli_fetch_array($result2);
      $count2 = mysqli_num_rows($result2);

      if ($count2 == 1) {
        $user_id = $row2['user_id'];
        $_SESSION['userId'] = $user_id;
      }

      header("location:../roles/user/welcome.php");
    } else {
      // Display errors to user
      foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <style>
    body {

      background-image: url(../images/h6.jpg);
      background-size: cover;
      transform: scale(0.80);
      /* scale the body by 75% */
      transform-origin: top;
      /* set the origin to the top of the page */

    }
  </style>
</head>

<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/signup.css">

<body>

  <!-- sign up -->
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration " style="border-radius: 15px;
                background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(243, 243, 243, 0.8))">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Sign up</h3>
              <form method="POST" action="" class="w-100">

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <label class="form-label" for="firstName">First Name</label>
                      <input type="text" name="txtFname" id="firstName" class="form-control form-control-lg" required />
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <label class="form-label" for="lastName">Last Name</label>
                      <input type="text" name="txtLname" id="lastName" class="form-control form-control-lg" required />
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <label for="birthdayDate" class="form-label">Birthday</label>
                      <input type="date" name="txtBdate" class="form-control form-control-lg" id="birthdayDate" required />
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="txtGender" type="radio" name="inlineRadioOptions" id="femaleGender" value="female" checked />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="txtGender" type="radio" name="inlineRadioOptions" id="maleGender" value="male" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <label class="form-label" for="emailAddress">Email</label>
                      <input type="email" name="txtEmail" id="emailAddress" class="form-control form-control-lg" required />
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <label class="form-label" for="phoneNumber">Phone Number</label>
                      <input type="tel" name="txtPhone" id="phoneNumber" class="form-control form-control-lg" required />
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <label class="form-label" for="password">Enter a password</label>
                    <input type="password" name="txtPassword" id="password" class="form-control form-control-lg" required />
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <label class="form-label" for="preference"></label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">

                    <select class="select form-control-lg" name="txtPreference">
                      <option value="1" disabled>Choose your preference</option>
                      <option value="lebanese">Lebanese</option>
                      <option value="italian">Italian</option>
                      <option value="mexican">Mexican</option>
                      <option value="indian">Indian</option>
                      <option value="chinese">Chinese</option>
                      <option value="german">German</option>
                      <option value="greek">Greek</option>
                      <option value="japanese">Japanese</option>
                      <option value="filipino">Filipino</option>
                    </select>
                    <label class="form-label select-label">Choose your favourite cuisine</label>

                  </div>
                </div>

                <div class="mt-4 pt-2">
                  <input class="btn btn-success btn-block btn-lg" type="submit" value="Submit" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="../js/popper.min.js"></script>
  <script src="../js/jquery-3.6.3.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>