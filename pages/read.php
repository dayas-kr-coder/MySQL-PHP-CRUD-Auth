<?php
// Check if a session is not already active
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page
  header("Location: ../auth/login.php");
  exit();
}

require_once '../config/connection.php';

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

if (!$result) {
  die("Error: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
  echo "
    <tr>
      <td>$row[regno]</td>
      <td>$row[sname]</td>
      <td>$row[course]</td>
      <td>$row[mark1]</td>
      <td>$row[mark2]</td>
      <td>$row[mark3]</td>
      <td>$row[result]</td>
      <td>
        <a href='./edit.php?id=$row[id]' class='btn btn-primary btn-sm' role='button'>Edit</a>
        <a href='./delete.php?id=$row[id]' class='btn btn-danger btn-sm' role='button'>Delete</a>
      </td>
    </tr>";
}

echo '</tbody>
    </table>';
