<?php

include '../PHPOnly/connect.php'; // this file will be used

$stmt = $conn->prepare('SELECT email, username, pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $username, $pfp);
$stmt->fetch();
$stmt->close();

// if statement checks if post-reply has been sent 
if (isset($_POST['post-reply'])) {
  
    $pid = $_POST["parent_id"];

    $content = $_POST["reply_content"]; // set these variables' value to the values of POSTs for parent_id and reply_content 


    // this is an alternate post submission without the img being included                                      1  2  3  4  5   values to send
    $stmt = $conn->prepare('INSERT INTO mordhaureplies (parent_id, username, email, pfp, reply_content) VALUES (?, ?, ?, ?, ?)');
    // prepare statement to insert a new reply record into mordhau replies
    $stmt->bind_param('issss', $pid, $username, $email, $pfp,  $content); // bind
    $stmt->execute(); // execute
    header('Location: ../index.php'); // redirect the user on their merry way to index.php (this is the home screen)




}



?>