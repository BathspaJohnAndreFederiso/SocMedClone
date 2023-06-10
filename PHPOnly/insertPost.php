<?php


$stmt = $conn->prepare('SELECT email, username, pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $username, $pfp);
$stmt->fetch();
$stmt->close();

//if(isset($_POST['createReply']))


// if statement checks if createPOST has been sent but the $_FILES for the img isn't
if (isset($_POST['createPost'])) {
    $uid = $_SESSION["id"];
    
    $content = $_POST["contents"];
    $tag = $_POST["tag"];

    if (!file_exists($_FILES['img-upload']['tmp_name']) && !is_uploaded_file($_FILES['img-upload']['tmp_name'])) {

        // this is an alternate post submission without the img being included                          1  2  3  4  5  6  values to send
        $stmt = $conn->prepare('INSERT INTO comments (owner_id, name, email, pfp, tag, content) VALUES (?, ?, ?. ?, ?, ?)');
        $stmt->bind_param('isssss', $uid, $username, $email, $pfp,  $tag, $content);
        $stmt->execute();
        header('Location: ../index.php'); // send the user on their merry way to index.php (this is the home screen)

    } else {

        $postImg = $_FILES['img-upload']; // set $postImg to $_FILES of img-upload
        $imgName = $postImg['name'];
        $imgType = $postImg['type'];
        $imgSize = $postImg['size'];
        $imgTmpName = $postImg['tmp_name'];
        $imgError = $postImg['error'];

        $imgFileData = explode('/', $imgType); // turns img Type into an string array using '/' as the separator, this will separate the output of 
        //'type' into values 'image' and the file type extension

        $imgExtension = $imgFileData[count($imgFileData) - 1]; // select the last item in $imgData (this is the file extension ex. png, jpg, jpeg)


        
        if ($imgExtension == 'jpg' || $imgExtension == 'png' || $imgExtension == 'jpeg') { // if statement that checks if the file extension is equal to png or jpg

            if ($imgSize < 5000000) { // check if the size of img is less than 5mb
                $uploadPath = "../Assets/PostMedia/".$imgName;
                $upload = move_uploaded_file($imgTmpName, $uploadPath);

                if ($upload) { // upload complete, lets run the SQL update statement

                    // code that will insert comment info into the database, with image                                      1  2  3  4  5  6  7 to send
                    if ($stmt = $conn->prepare('INSERT INTO comments (owner_id, name, email, pfp, img, tag, content) VALUES (?, ?, ?, ?, ?, ?, ?)')) {

                        $stmt->bind_param('issssss', $uid, $username, $email, $pfp, $imgName, $tag, $content);
                        $stmt->execute(); // execute
                        header('Location: ../Index.php'); // send the user on their merry way to Index.php 
                        exit();


                    } else {
                        //  somehow the SQL got an error here, check if the table has the account fields used in the if-statement.
                        $_SESSION["Error"] = "SQL Error. Please contact the developers for database fixes.";
                        header("Location: ../Index.php");
                        exit();
                    }

                }


            } else { // else runs if the if-condition was not triggered

                $_SESSION["Error"] = "Image must be below 5mb.";
                header("Location: ../Index.php");
                exit();
            }

        } else { // else runs if the image type is neither of the three
            $_SESSION["Error"] = "Image type not supported. .PNG, .JPG and .JPEG only.";
            header("Location: ../Index.php");
            exit();
        }
    }

}



?>