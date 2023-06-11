<!-- This is the php -->
<?php
// Start the session, this needs to be done before the first HTML tag

include 'connect.php';

if (!isset($_POST['username'], $_POST['password1'], $_POST['password2'], $_POST['email'])) { // if any of the posts are not set run this code
    // Could not get the data that should have been sent. 
    $_SESSION["Error"] = "Please complete the registration form!";
    header("Location: ../registration.php"); // note that this code cannot actually trigger since the input forms on the HTML are set to required
}

if (empty($_POST['username']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['email'])) { // checks if any one of the four inpuit fields is empty
    $_SESSION["Error"] = "One of the forms is empty, please complete all of them!";
    header("Location: ../registration.php");
}


if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE email = ?')) { // $stmt variable connects to database with a prepared statement
    $newEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // $newemail value is a sanitized POST_email, clearing any illegal characters 
    // prepared statement selects the id and password from accounts associated with a provided username parameter
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    // the username form will now be expecting a string value to be entered, minimizing the risk 
    $stmt->bind_param('s', $newEmail); // bind the emailacquired from the POST to the prepared statement
    $stmt->execute(); // execute the prepared statement
    // Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
    $stmt->store_result();


    if ($stmt->num_rows > 0) { // checks if stmt's rows are greater than 0, means its found a result that matches the passed in parameter
        $_SESSION["Error"] = "This email is already registered!"; // display message
        header("Location: ../registration.php"); // redirect back to registration.php
    } else if ($_POST['password1'] === $_POST['password2']) { // check if passwords match and stmt did not return aresult

        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) { // $stmt variable connects to database with a prepared statement
            // prepared statement selects the id and password from accounts associated with a provided username parameter
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            // the username form will now be expecting a string value to be entered, minimizing the risk 
            $stmt->bind_param('s', $_POST['username']); // bind the username acquired from the POST to the prepared statement
            $stmt->execute(); // execute the prepared statement
            // Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
            $stmt->store_result();


            if ($stmt->num_rows > 0) { // checks if stmt's rows are greater than 0, means its found a result that matches the passed in parameter
                $_SESSION["Error"] = "This user already exists!";
                header("Location: ../registration.php");
            } else {

                // code that runs if there is no existing username already
                if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT); 
                    $stmt->bind_param('sss', $_POST['username'], $password, $newEmail); // insert the values of password1, POST username and $newemail into the parameters of the prepared statement
                    $stmt->execute();

                    // execute and display a success message
                    $_SESSION["Error"] = "Enlisted! You may log in now.";
                    header('Location: ../Login.php'); // send the user on their merry way to login.php 

                } else {
                    //  somehow the SQL got an error, check if the table has the three account fields used in the statement.
                    echo 'Could not prepare statement!';
                }
            }


            $stmt->close(); // close database connection
        }
    } else {
        $_SESSION["Error"] = "Passwords do not match!"; // passwords do not match
        header("Location: ../registration.php"); // redirect to registration
    }
}
?>