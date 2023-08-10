<?php

session_start();

include "../../../includes/connection.php";

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../../index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstName = $_POST['txtFname'];
  $lastName = $_POST['txtLname'];
  $email = $_POST['txtEmail'];
  $phone = $_POST['txtPhone'];
  $date = $_POST['txtBdate'];
  $password = $_POST['txtPassword'];
  $gender = $_POST['txtGender'];
  // $userRole = $_POST['txtRole1'];
  $moderator = "moderator";

  // Calculate the age of the user based on the date of birth
  $age = date_diff(date_create($date), date_create('today'))->y;

  $qry = "SELECT * FROM login_users WHERE email = '$email'";
  $result = mysqli_query($con, $qry);
  $count = mysqli_num_rows($result);

  if ($count > 0)

    echo "<script>alert('Moderator already exist');</script>";

  else {

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
      $errors[] = "moderator must be 16 years old or older to register.";
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
      $sql = "INSERT INTO login_users (first_name, last_name, email,  password, phone, date, role, gender)
          VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$date', '$moderator', '$gender')";
      mysqli_query($con, $sql) or die(mysqli_error($con));

      header("location:../addModerator.php");
    } else {
      // Display errors to user
      foreach ($errors as $error) {
        // echo "<p>$error</p>";
        echo "<script>alert('$error');</script>";
      }
    }
  }
}


?>