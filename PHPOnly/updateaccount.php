<!-- This is the php -->
<?php
// Start the session, this needs to be done before the first HTML tag

include 'connect.php';

$id = $_SESSION['id'];

if (!isset($_POST['username'], $_POST['email'])) { // this will not run regardless since the forms are set to required in the HTML/PHP page
    // Could not get the data that should have been sent.
    $_SESSION["Error"] = "Fill in the form before submitting.";
    header("Location: ../userprofile.php");
    exit();
}

if (isset($_POST['update'])) { // if statement that runs once POST update is received
    $newUsername = htmlspecialchars($_POST['username']);
    $newEmail = htmlspecialchars($_POST['email']); // set both variables to htmlspecialchars validated POSTs for both email and username
    $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL); // sanitize $newEmail further, removing illegal characters
    $newProfilePic = $_FILES['pfp-upload']; // set $newProfilePic to $_FILES of pfp-upload


    if (!empty($newUsername) && !empty($newEmail)) { // if both variables are not empty

        $pfpName = $newProfilePic['name'];
        $pfpType = $newProfilePic['type'];
        $pfpSize = $newProfilePic['size'];
        $pfpTmpName = $newProfilePic['tmp_name'];
        $pfpError = $newProfilePic['error'];
        // get relevant data of the image to be passed

        $pfpFileData = explode('/', $pfpType); // turns pfp Type into an string array using '/' as the separator, this will separate the output of 
        //'type' into values 'image' and the file type extension

        $pfpExtension = $pfpFileData[count($pfpFileData) - 1]; // select the last item in $pfpFileData (this is the file extension ex. png, jpg, jpeg)


        if ($pfpExtension == 'jpg' || $pfpExtension == 'png' || $pfpExtension == 'jpeg') { // if statement that checks if the file extension is equal to png or jpg

            if ($pfpSize < 5000000) { // check if the size of pfp is less than 5mb
                $uploadPath = "../Assets/pfps/".$pfpName;
                $upload = move_uploaded_file($pfpTmpName, $uploadPath);

                if ($upload) { // upload complete, lets run the SQL update statement

                    // code that runs if this user's id exists in the database
                    if ($stmt = $conn->prepare('UPDATE accounts SET username = (?), email = (?), pfp = (?) WHERE id = ?')) {

                        $stmt->bind_param('sssi', $newUsername, $newEmail, $pfpName, $_SESSION['id']); // bind the four parameters of the prepared statements
                        $stmt->execute(); // execute
                        header('Location: ../userprofile.php'); // send the user on their merry way to userprofile.php 
                        exit();


                    } else {
                        //  somehow the SQL got an error here, check if the table has the account fields used in the if-statement.
                        $_SESSION["Error"] = "SQL Error. Please contact the developers for database fixes.";
                        header("Location: ../userprofile.php");
                        exit();
                    }

                }


            } else { // else runs if the if-condition was not triggered

                $_SESSION["Error"] = "Image must be below 5mb.";
                header("Location: ../userprofile.php");
                exit();
            }

        } else { // else runs if the image type is neither of the three
            $_SESSION["Error"] = "Image type not supported. .PNG, .JPG and .JPEG only.";
            header("Location: ../userprofile.php");
            exit();
        }

    } else { // else runs if none of the forms have been filled
        $_SESSION["Error"] = "Fill in the forms before submitting.";
        header("Location: ../userprofile.php");
        exit();
    }



    //$stmt->close(); // close database connection

}