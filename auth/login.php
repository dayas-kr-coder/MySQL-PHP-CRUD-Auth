<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: ../pages/teachers.php");
  exit;
}

include_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate inputs (you should add more validation as needed)
  if (empty($username) || empty($password)) {
    $error = "Please fill in all the fields";
  } else {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../pages/teachers.php");
        exit;
      } else {
        $error = "Invalid password";
      }
    } else {
      $error = "Invalid username";
    }
  }
}

include_once '../templates/header.php';
?>

<title>Login</title>
<?php include_once('../bootstrap/bootstrap.php'); ?>

<div class="container col-4 my-5">
  <h2 class="mb-4">Login</h2>

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
      <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>
    </div>
  </form>
</div>

<?php include_once '../templates/footer.php'; ?>