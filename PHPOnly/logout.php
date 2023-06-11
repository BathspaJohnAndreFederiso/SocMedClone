<?php
session_start();
session_destroy(); // this will logout the user by destroying all session tags
// Redirect to the login page:
header('Location: ../login.php');
?>