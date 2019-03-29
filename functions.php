<?php
/*
Defines functions to connect to the Database, retrieve the result and 
return them. You need several functions for different questions
*/

function getDB()
{
	
	$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	
	return $conn;
}

function runQuery($db, $query) {
	
	$result = mysqli_query($db,$query);
	return $result;
}


?>
