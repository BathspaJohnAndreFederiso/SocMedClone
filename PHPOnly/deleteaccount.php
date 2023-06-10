<?php 


include 'connect.php'; // this file will be used by login.php in its login form


$stmt = $conn->prepare('DELETE FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute(); // execute the prepared statement using the binded parameter

$stmt->close(); // bind to a variable, fetch then close


$_SESSION["Error"] = "". $_SESSION['name'] ." has been deleted.";
session_destroy(); // destroy all sessions, return to logout
// Redirect to the login page:

header('Location: ../login.php');
exit();
?>