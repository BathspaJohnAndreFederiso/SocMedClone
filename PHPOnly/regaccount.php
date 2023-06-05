<!-- This is the php -->
<?php
// Start the session, this needs to be done before the first HTML tag

include '../connect.php';

if (!isset($_POST['username'], $_POST['password1'], $_POST['password2'], $_POST['email'])) {
	// Could not get the data that should have been sent.
    $_SESSION["statMessage"] = "Please complete the registration form!";
	header ("Location: ../registration.php");
}

if(empty($_POST['username']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['email'])){ // checks if any one of the three inpuit fields is empty
    $_SESSION["statMessage"] = "One of the forms is empty, please complete all of them!";
	header ("Location: ../registration.php");
}


if ($stmt = $conn->prepare('SELECT id, password FROM crocaccounts WHERE email = ?')) { // $stmt variable connects to database with a prepared statement
    // prepared statement selects the id and password from crocaccounts associated with a provided username parameter
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    // the username form will now be expecting a string value to be entered, minimizing the risk 
	$stmt->bind_param('s', $_POST['email']); // bind the username acquired from the POST to the prepared statement
	$stmt->execute(); // execute the prepared statement
	// Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
	$stmt->store_result();


    if ($stmt->num_rows > 0) { // checks if stmt's rows are greater than 0, means its found a result that matches the passed in parameter
        $_SESSION["statMessage"] = "This email is already registered!";
	    header ("Location: ../registration.php");
    } 

}

if($_POST['password1'] === $_POST['password2']){ // check if passwords match

 if ($stmt = $conn->prepare('SELECT id, password FROM crocaccounts WHERE username = ?') ) { // $stmt variable connects to database with a prepared statement
    // prepared statement selects the id and password from crocaccounts associated with a provided username parameter
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    // the username form will now be expecting a string value to be entered, minimizing the risk 
	$stmt->bind_param('s', $_POST['username']); // bind the username acquired from the POST to the prepared statement
	$stmt->execute(); // execute the prepared statement
	// Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
	$stmt->store_result();


    if ($stmt->num_rows > 0) { // checks if stmt's rows are greater than 0, means its found a result that matches the passed in parameter
        $_SESSION["statMessage"] = "This user already exists!";
	    header ("Location: ../registration.php");
    } else {

        // code that runs if there is no existing username already
        if($stmt = $conn->prepare('INSERT INTO crocaccounts (username, password, email) VALUES (?, ?, ?)')){
            $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();

            session_regenerate_id(); // regenerate id for this session
            $_SESSION['loggedin'] = TRUE; // set a session cookie for loggedin to true
            $_SESSION['name'] = $_POST['username']; 
            $_SESSION['email'] = $_POST['email']; // set session cookies for the name to the POST's username and email values
            $_SESSION['id'] = $id; // set session id to the $id variable
            header('Location: ../index.php'); // send the user on their merry way to index.php (this is the home screen)

            echo 'User Registered. Logging In...';
        }else{
            //  somehow the SQL got an error, check if the table has the three account fields used in the statement.
	        echo 'Could not prepare statement!';
        }
    }


	$stmt->close(); // close database connection
}
}else{
    $_SESSION["Error"] = "Passwords do not match!";
    header ("Location: Registration.php");
}
?>