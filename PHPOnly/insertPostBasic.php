<?php

include '../PHPOnly/connect.php'; // this file will be used

$stmt = $conn->prepare('SELECT email, username, pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $username, $pfp);
$stmt->fetch();
$stmt->close();

//if(isset($_POST['createReply']))


// if statement checks if createPOST has been sent but the $_FILES for the img isn't
if (isset($_POST['post-reply'])) {
  
    $pid = $_POST["parent_id"];

    $content = $_POST["reply-content"];
    $tag = $_POST["tag"];

    // this is an alternate post submission without the img being included                            1  2  3  4  5   values to send
    $stmt = $conn->prepare('INSERT INTO mordhaureplies (parent_id, name, email, pfp, reply-content) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('isssss', $pid , $username, $email, $pfp,  $content);
    $stmt->execute();
    header('Location: ../index.php'); // send the user on their merry way to index.php (this is the home screen)




}



?>