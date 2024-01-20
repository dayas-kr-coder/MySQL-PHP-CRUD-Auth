<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // If the user is not logged in, redirect to login.php
  header("Location: ../auth/login.php");
  exit;
}

include_once '../templates/header.php';

// Database connection
include_once '../config/connection.php';

$errorMsg = "";
$successMsg = "";

if (isset($_POST['submit'])) {
  $regno = $_POST['regno'];
  $sname = $_POST['sname'];
  $course = isset($_POST['course']) ? $_POST['course'] : '';
  $mark1 = $_POST['mark1'];
  $mark2 = $_POST['mark2'];
  $mark3 = $_POST['mark3'];

  // Check if marks are numeric
  if (!is_numeric($mark1) || !is_numeric($mark2) || !is_numeric($mark3)) {
    $errorMsg = "Marks should be numeric.";
  } else {
    $tmark = ($mark1 + $mark2 + $mark3);

    if ($mark1 < 40 || $mark2 < 40 || $mark3 < 40) {
      $result = "Failed";
    } else if ($tmark < 150) {
      $result = "Passed";
    } else if ($tmark < 180) {
      $result = "Second Class";
    } else if ($tmark < 255) {
      $result = "First Class";
    } else {
      $result = "Distinction";
    }
  }

  do {
    if (empty($regno) || empty($sname) || empty($course) || empty($mark1) || empty($mark2) || empty($mark3) || empty($result)) {
      $errorMsg = "Please fill in all the fields";
      break;
    }

    // Check if the regno is unique
    $regnoCheckQuery = "SELECT COUNT(*) as count FROM student WHERE regno = '$regno'";
    $regnoCheckResult = $conn->query($regnoCheckQuery);

    if (!$regnoCheckResult) {
      $errorMsg = "Error checking regno uniqueness: " . $conn->error;
      break;
    }

    $regnoCount = $regnoCheckResult->fetch_assoc()['count'];

    if ($regnoCount > 0) {
      $errorMsg = "Resister Number already exists. Please use a different resister number.";
      break;
    }

    $successMsg = "Student added successfully";

    // Insert the student into the database
    $sql = "INSERT INTO student (regno, sname, course, mark1, mark2, mark3, result) VALUES ('$regno', '$sname', '$course', '$mark1', '$mark2', '$mark3', '$result')";
    $result = $conn->query($sql);

    if (!$result) {
      $errorMsg = "Error: " . $conn->error;
      break;
    }

    // Redirect to teachers.php
    header("Location: ./teachers.php");
    exit;
  } while (false);
}
?>
<title>Add Student</title>
<?php include_once('../bootstrap/bootstrap.php'); ?>

<div class="container col-8 my-5">
  <h2 class="mb-4">New Student</h2>

  <?php
  // Show error message
  if (!empty($errorMsg)) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" . $errorMsg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  // Show success message
  if (!empty($successMsg)) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . $successMsg . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  ?>
  <form method="post" class="form border py-3 px-4 rounded-4">
    <div class="mb-3">
      <label for="regno" class="form-label">Resister Number</label>
      <input type="text" class="form-control" id="regno" name="regno" placeholder="Enter Resister Number">
    </div>
    <div class="mb-3">
      <label for="sname" class="form-label">Student Name</label>
      <input type="text" class="form-control" id="sname" name="sname" placeholder="Enter Student Name">
    </div>
    <div class="mb-3">
      <label for="course" class="form-label">Course</label>
      <input type="text" class="form-control" id="course" name="course" placeholder="Enter Course">
    </div>
    <div class="d-flex gap-2 justify-content-between">
      <div class="mb-3 w-100">
        <label for="mark1" class="form-label">Mark 1</label>
        <input type="text" class="form-control" id="mark1" name="mark1" placeholder="Enter Mark 1">
      </div>
      <div class="mb-3 w-100">
        <label for="mark2" class="form-label">Mark 2</label>
        <input type="text" class="form-control" id="mark2" name="mark2" placeholder="Enter Mark 2">
      </div>
      <div class="mb-3 w-100">
        <label for="mark3" class="form-label">Mark 3</label>
        <input type="text" class="form-control" id="mark3" name="mark3" placeholder="Enter Mark 3">
      </div>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary w-100 mb-3" name="submit">Submit</button>
      <a href="../index.php" class="btn btn-outline-secondary w-100" role="button">Cancel</a>
    </div>
  </form>
</div>

<?php include_once '../templates/footer.php'; ?>