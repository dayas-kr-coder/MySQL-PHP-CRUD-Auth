<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // If the user is not logged in, redirect to login.php
  header("Location: ../auth/login.php");
  exit;
}

include_once '../templates/header.php';
?>
<title>CRUD</title>
<?php include_once('../bootstrap/bootstrap.php'); ?>

<div class="conatiner my-3 p-4">
  <h2>List of Clients</h2>
  <a href="./create.php" class="btn btn-primary my-3 mt-4" role="button">New Client</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Reg No.</th>
        <th>Name</th>
        <th>Course</th>
        <th>Mark 1</th>
        <th>Mark 2</th>
        <th>Mark 3</th>
        <th>Result</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php include_once('./read.php'); ?>

    </tbody>
  </table>
</div>

<?php include_once '../templates/footer.php'; ?>