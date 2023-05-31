<?php // this file will be used by LoginPage.php in its login form
// Try to connect using this info

include 'connect.php';

if (!isset($_POST['username'], $_POST['password']) ) { // error checking if session tags for 'username' and 'password' are not set
	// displays this message to user
    $_SESSION["errormsg"] = "Please fill the username and password!";
    
    header ("Location: login.php");
}

if ($stmt = $conn->prepare('SELECT id, password FROM crocaccounts WHERE username = ?')) { // $stmt variable connects to database with a prepared statement
    // prepared statement selects the id and password from crocaccounts associated with a provided username parameter
	// bound parameter types are represented by the first letter of ther name (s = string, i = int, b = blob, etc). the username data type is a string so it uses "s"
    // the username form will now be expecting a string value to be entered, minimizing the risk 
	$stmt->bind_param('s', $_POST['username']); // bind the username acquired from the POST to the prepared statement
	$stmt->execute(); // execute the prepared statement
	// Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
	$stmt->store_result(); 


    if ($stmt->num_rows > 0) { // checks if stmt's num_rows > 0 (means there is a result returned) 
        $stmt->bind_result($id, $password); // bind results of $stmt to new variables $id and $password
        $stmt->fetch();  
        // verify the password since the given account actually exists in the database
        // Remember to use PASSWORD_HASH setting in your registration PHP file to store passwords.
        if (password_verify($_POST['password'], $password)) { // check to see if the POST value is equal to the existing one from the database
            // since it's verified the entered credentials successfully, initiate log-in 
            // Create session tags, so the site will know the user and their attached information (if any).
            session_regenerate_id(); // regenerate id just in case
            $_SESSION['logged_in'] = TRUE; // set a session cookie for logged_in to true
            $_SESSION['name'] = $_POST['username']; // set a session cookie for the name to the POST's username value
            $_SESSION['id'] = $id; // set session id to the $id variable
            header('Location: ../index.php'); // redirect the user to index.php (this is the main screen usually)
        } else {
            // code that runs if the password is WRONG
            
            
               // put the "error element must trigger" here  
               // - Create element > input exit text in element
            $_SESSION["errormsg"] = "Invalid Password!";
            header ('Location: ../login.php');
        }
    } else {
        // code that runs if the username is WRONG
            $_SESSION["statMessage"] = "Invalid Username!";
            header ('Location: ../login.php');
    }


	$stmt->close(); // close database connection
}

?>