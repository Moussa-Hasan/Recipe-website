<?php

session_start();

if (!isset($_SESSION['EmailAdmin']))
  header("location:../../index.php");

// Establish a database connection
include "../../includes/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $user_id = $_POST["user_id"];

  $sql = "DELETE FROM login_users WHERE user_id = '$user_id'";

  if (mysqli_query($con, $sql)) {
    echo "user deleted successfully";
  } else {
    echo "Error deleting user: " . mysqli_error($con);
  }

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
  <br>

  <!-- manage users  -->
  <br>
  <div class="content">
    <h1>Manage Users</h1>
    <br>
    <div class="row">
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
            <input type="text" class="form-control" id="searchInput" placeholder="Search by name, ID, email, or role." aria-describedby="search-addon">
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <table class="table table-striped mt-4">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Email</th>
              <th>Date Of Birth</th>
              <th>Role</th>
              <th>User Id</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

            include "../../includes/connection.php";

            $sql = "SELECT * FROM login_users WHERE role IN ('user', 'moderator');";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
              // Output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td>' . $row['first_name'] . '<span style="color: transparent;" hidden>' . $row['user_id'] . '</span><span style="color: transparent;" hidden>' . $row['last_name'] . '</span>
                <span style="color: transparent;" hidden>' . $row['email'] . '</span><span style="color: transparent;" hidden>' . $row['role'] . '</span></td>';
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>";
                echo '<a href="#" data-toggle="modal" data-target="#deleteUserModal" data-id="' . $row['user_id'] . '"><img src="../../images/delete.png" alt="Delete" width="30" height="30"></a>';
                echo "</td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }
            mysqli_close($con);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- Delete User Modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteUserModalLabel">Delete User?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this User?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/bootstrap.js"></script>

  <script>
    function deleteUser() {
      var user_id = $('#deleteUserModal').data('id');
      $.ajax({
        url: '',
        type: 'post',
        data: {
          user_id: user_id
        },
        success: function(response) {
          // Refresh the page after successful deletion
          location.reload();
        }
      });
    }

    $('#deleteUserModal').on('show.bs.modal', function(e) {
      var user_id = $(e.relatedTarget).data('id');
      $(this).data('id', user_id);
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