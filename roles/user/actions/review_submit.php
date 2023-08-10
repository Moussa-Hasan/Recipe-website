<?php

session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../../index.php");

include "../../../includes/connection.php";

$user_id = $_POST['user_id'];
$recipe_id = $_POST['recipe_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

if (!$con) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Insert the review data into the database
$sql = "INSERT INTO feedback (user_id, recipe_id, rate, review, create_date) VALUES ('$user_id', '$recipe_id', '$rating', '$comment', NOW())";
if (mysqli_query($con, $sql)) {
    // Redirect the user to the recipe page
    header('Location:../recipe_details.php?id=' . $recipe_id . '#feedback');
    exit;
} else {
    echo 'Error: ' . $sql . '<br>' . mysqli_error($con);
}


mysqli_close($con);

?>
