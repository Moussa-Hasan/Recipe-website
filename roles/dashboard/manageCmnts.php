<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../index.php");

// Establish a database connection
include "../../includes/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $feedback_id = $_POST["feedback_id"];

  $sql = "DELETE FROM feedback WHERE feedback_id = '$feedback_id'";

  if (mysqli_query($con, $sql)) {
    echo "Feedback deleted successfully";
  } else {
    echo "Error deleting feedback: " . mysqli_error($con);
  }

  // Close database connection
  mysqli_close($con);
}


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

  <!-- manage comments  -->
  <br>

  <h1>Manage Comments and Reviews</h1><br>

  <div class="container">
    <div class="d-flex justify-content-end flex-grow-1">
      <div class="input-group input-group-sm ml-auto">
        <div class="input-group-prepend">
          <span class="input-group-text" id="search-addon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
          </span>
        </div>
        <input type="text" class="form-control" id="searchInput" placeholder="Search by recipe name or by user name." aria-describedby="search-addon">
      </div>
    </div>
  </div>

  <?php

  // Establish a database connection
  include "../../includes/connection.php";

  // Query feedback data
  $sql = "SELECT feedback.feedback_id, recipes.name, feedback.review, feedback.user_id,
   login_users.first_name, login_users.last_name, feedback.create_date, feedback.rate, feedback.recipe_id
        FROM feedback
        JOIN login_users ON feedback.user_id = login_users.user_id
        JOIN recipes ON feedback.recipe_id = recipes.recipe_id
       ";
  $result = mysqli_query($con, $sql);

  // Display feedback data in table
  if (mysqli_num_rows($result) > 0) {
    echo '<div class="content">';
    // echo '<h1>Manage Comments and Reviews</h1>';
    echo '<br>';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<div class="card mb-12">';
    echo '<div class="card-body">';
    echo '<table class="table table-hover">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Recipe Id</th>';
    echo '<th scope="col">Recipe</th>';
    echo '<th scope="col">Comment/Review</th>';
    echo '<th scope="col">Rate</th>';
    echo '<th scope="col">Submitted By</th>';
    echo '<th scope="col">User Id</th>';
    echo '<th scope="col">Date Submitted</th>';
    echo '<th scope="col">Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through feedback data
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['recipe_id'] . '<span style="color: transparent;" hidden>' . $row['last_name'] . '</span><span style="color: transparent;" hidden>' . $row['first_name'] . '</span>
      <span style="color: transparent;" hidden>' . $row['name'] . '</span></td>';
      echo '<th scope="row">' . $row['name'] . '</th>';
      echo '<td>' . $row['review'] . '</td>';
      echo '<td>' . $row['rate'] . ' Stars</td>';
      echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
      echo '<td>' . $row['user_id'] . '</td>';
      echo '<td>' . $row['create_date'] . '</td>';
      echo '<td>';
      echo '<a href="#" data-toggle="modal" data-target="#deleteCommentModal" data-id="' . $row['feedback_id'] . '"><img src="../../images/delete.png" alt="Delete" width="30" height="30"></a>';
      echo '</td>';
      echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  } else {
    echo "No feedback data found.";
  }

  // Close database connection
  mysqli_close($con);
  ?>


  <!-- Delete Comment Modal -->
  <div class="modal fade" id="deleteCommentModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteCommentModalLabel">Delete Comment?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this comment?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="deleteFeedback()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>

  <script>
    function deleteFeedback() {
      var feedback_id = $('#deleteCommentModal').data('id');
      $.ajax({
        url: '',
        type: 'post',
        data: {
          feedback_id: feedback_id
        },
        success: function(response) {
          // Refresh the page after successful deletion
          location.reload();
        }
      });
    }

    $('#deleteCommentModal').on('show.bs.modal', function(e) {
      var feedback_id = $(e.relatedTarget).data('id');
      $(this).data('id', feedback_id);
    });

    // Get the input field and table
    var searchInput = document.getElementById("searchInput");
    var table = document.getElementsByTagName("table")[0];

    // Add event listener to input field
    searchInput.addEventListener("keyup", function() {
      // Declare variables
      var filter, tr, td, i, txtValue;
      filter = searchInput.value.toLowerCase();
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Change index to match the column of the name
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    });
  </script>
</body>

</html>