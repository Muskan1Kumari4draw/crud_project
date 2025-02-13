<?php
// INSERT INTO `notes` (`sno.`, `Title`, `Description`, `tstamo`) VALUES ('1', 'Muskan', 'Go to add the description ', '2024-07-13 12:53:50.000000');
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// die if connection was not successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['snoEdit'])){
    // Update the record
      $sno = $_POST["snoEdit"];
      $title = $_POST["titleEdit"];
      $description = $_POST["descriptionEdit"];
  
    // Sql query to be executed
    $sql = "UPDATE `notes` SET `Title` = '$title' , `Description` = '$description' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
  }
  else{
      echo "We could not update the record successfully";
  }
  }
  else{
      $title = $_POST["title"];
      $description = $_POST["description"];
  
    // Sql query to be executed
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
  
     
    if($result){ 
        $insert = true;
    }
    else{
        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    } 
  }
  }
  ?>




<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->


  <title>myNotes - Notes Made easy to learn</title>
</head>

<body>

  <!-- Edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" >
        <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="text" class="form-group">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-1">
              <label for="desc" class="form-label">Note description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
        </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us </a>
          </li>
        </ul>
        <div class="ms-auto">
          <form class="form-inline my-2 my-lg-0 " method="POST">
            <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your record has been successfully inserted:
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden'true'>&times;</span></button>
</div>";
  }
  ?>
   <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your record has been successfully deleted:
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden'true'>&times;</span></button>
</div>";
  }
  ?>
   <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your record has been successfully updated:
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden'true'>&times;</span></button>
</div>";
  }
  ?>
  <div class="container my-4">
    <h1>Add a Note</h1>
    <form action="/crud_project/index.php" method="post">
      <div class="mb-3 my-2">
        <label for="exampleInputEmail1" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-1">
        <label for="desc" class="form-label">Note description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-2">Add Note</button>
    </form>
  </div>
  <div class="container" my-4>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S no.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo  "<tr>
      <th scope='row'>" . $sno . "</th>
      <td>" . $row['Title'] . "</td>
      <td>" . $row['Description'] . "</td>
      <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> 
<button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button> </td>
        </tr>";
        };

        ?>
      </tbody>
    </table>

  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    // edits = document.getElementsByClassName('edit');
    // Array.from(edits).forEach((element) => {
    //   element.addEventListener('click', (e) => {
    //     console.log("edit", );
    //     tr = e.target.parentNode.parentNode;
    //     title = tr.getElementsByTagName("td")[0].innerText;
    //     description = tr.getElementsByTagName("td")[1].innerText;
    //     console.log(title, description);
    //     titleEdit.value = title;
    //     descriptionEdit.value = description;
    //     snoEdit.value = e.target.id;
    //     console.log(e.target.id);
    //     $('#editModal').modal('toggle');
    //   })
    // })

    $(document).ready(function() {
      var titleEdit = document.getElementById('titleEdit');
      var descriptionEdit = document.getElementById('descriptionEdit');
      var snoEdit = document.getElementById('snoEdit');

      var edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener('click', (e) => {
          console.log("edit");
          var tr = e.target.parentNode.parentNode;
          var title = tr.getElementsByTagName("td")[0].innerText;
          var description = tr.getElementsByTagName("td")[1].innerText;
          console.log(title, description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('show');
        });
      });
    });

    var deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener('click', (e) => {
          console.log("delete");
          var sno = e.target.id.substr(1,);
          
      if( confirm("Are you sure you want  to delete this note!")){
        console.log("yes");
        window.location = `/crud_project/index.php?delete= ${sno}`;
        //Create a form and use a post request to submit a form
      }else{
        console.log("no");
      }
        });
      });

  </script>
</body>

</html>