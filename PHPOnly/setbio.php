<!-- This is the php -->
<?php
// Start the session, this needs to be done before the first HTML tag

include 'connect.php';

if (!isset($_POST['userBio'])) {
    // Could not get the data that should have been sent.
    $_SESSION["Error"] = "Fill in the form before submitting.";
    header("Location: ../userprofile.php");
    exit();
}

// code that runs if this user's id exists in the database
if ($stmt = $conn->prepare('UPDATE accounts SET bio = (?) WHERE id = ?')) {

    $stmt->bind_param('si', $_POST['userBio'], $_SESSION['id']); // bind the two parameters of the prepared statements
    $stmt->execute(); // execute
    header('Location: ../userprofile.php'); // send the user on their merry way to userprofile.php 
    exit();


} else {
    //  somehow the SQL got an error here, check if the table has the account fields used in the if-statement.
    $_SESSION["Error"] = "SQL Error. Please contact the developers for database fixes.";
    header("Location: ../userprofile.php");
    exit();
}