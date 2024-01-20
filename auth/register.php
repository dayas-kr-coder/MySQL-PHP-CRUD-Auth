<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: ../pages/teachers.php");
  exit;
}

include_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate inputs (you should add more validation as needed)
  if (empty($username) || empty($password)) {
    $error = "Please fill in all the fields";
  } else {
    // Hash the password using password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql)) {
      header("Location: login.php");
      exit;
    } else {
      $error = "Error in registration. Please try again.";
    }
  }
}

include_once '../templates/header.php';
?>

<title>Register</title>
<?php include_once('../bootstrap/bootstrap.php'); ?>

<div class="container col-4 my-5">
  <h2 class="mb-4">Register</h2>

  <?php if (isset($error)) : ?>
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <?php echo $error; ?>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  <?php endif; ?>

  <form method="post" class="form border py-3 px-4 rounded-4">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>
    <div class="mb-3">
      <button type="submit" name="register" class="btn btn-primary w-100 mb-3">Register</button>
    </div>
  </form>
</div>


<?php include_once '../templates/footer.php'; ?>