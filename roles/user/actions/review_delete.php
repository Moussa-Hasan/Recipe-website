
<?php
session_start();

if (!isset($_SESSION['EmailUser']))
    header("location:../../../index.php");

if (isset($_POST['delete_feedback'])) {

    $feedback_id = $_POST['feedback_id'];
    $recipe_id = $_POST['recipe_id'];
    
    include "../../../includes/connection.php";

    $sql = "DELETE FROM feedback WHERE feedback_id = $feedback_id";

    if (mysqli_query($con, $sql)) {
        header('Location:../recipe_details.php?id=' . $recipe_id . '#feedback');
        // header("Cache-Control: no-cache, must-revalidate");
        exit;
    } else {
        echo 'Error deleting feedback: ' . mysqli_error($con);
    }
    mysqli_close($con);
}
?>