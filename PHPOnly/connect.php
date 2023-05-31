<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "mordhubdb"); // change the last parameter in this to whatever your database's name is 

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('The connection has failed. Reason: ' . mysqli_connect_error());
}
?>