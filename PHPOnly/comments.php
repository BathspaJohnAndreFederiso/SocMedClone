<?php 

include 'connect.php';

$sqlNumComments = $conn->query(query: "SELECT id FROM comments");
$numComments = $sqlNumComments->num_rows;

?>