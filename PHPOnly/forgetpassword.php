<!-- This is the php -->
<?php
// Start the session, this needs to be done before the first HTML tag

include 'connect.php';

if (!isset($_POST['email'], $_POST['password1'], $_POST['password2'])) {
	// Could not get the data that should have been sent.
	$_SESSION["Error"] = "Please complete all forms!";
    header ("Location: ../forgetpass.php");
    exit();
}

if($_POST['password1'] === $_POST['password2']){ // check if the two password forms match
    

  if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE email = ?')) { // $stmt variable connects to database with a prepared statement
    // prepared statement selects the id and password from accounts associated with a provided username parameter
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    // the username form will now be expecting a string value to be entered, minimizing the risk 
	$stmt->bind_param('s', $_POST['email']); // bind the username acquired from the POST to the prepared statement
	$stmt->execute(); // execute the prepared statement
	// Store the results of $stmt (which are the provided details run through the prepared statement) so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) { // checks if stmt's rows are greater than 0, means its found a result that matches the passed in parameter
        
        // code that runs if this user email exists
        if($stmt = $conn->prepare('UPDATE accounts SET password = (?) WHERE email = ?')){
            

            $password = password_hash($_POST['password1'], PASSWORD_DEFAULT); // hash the password1 POST and set to a variable
            $stmt->bind_param('ss', $password, $_POST['email']); // bind the three parameters of the prepared statement with the variable above, the username and email POSTs
            $stmt->execute(); // execute
            $_SESSION["Error"] = "Password changed!";
            header('Location: ../login.php'); // send the user on their merry way to login.php 
            
            
        }else{
            //  somehow the SQL got an error here, check if the table has the account fields used in the if-statement.
	        $_SESSION["Error"] = "SQL Error. Please contact the developers for database fixes.";
            header ("Location: ../forgetpass.php");
        }

    } else {
        $_SESSION["Error"] = "This email does not exist in our database.";
        header ("Location: ../forgetpass.php");
        exit();
    }


	$stmt->close(); // close database connection
  }


} else{
    $_SESSION["Error"] = "Passwords do not match!";
    header ("Location: ../forgetpass.php");
}