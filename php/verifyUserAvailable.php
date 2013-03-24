<?php
	require 'db.inc.php';

	$username = $_GET['name'];

	$query = "SELECT * FROM registered_users where username = ". $username;
	$queryResult = mysqli_query($link, $query);
	$num_results = mysqli_num_rows($queryResult); 
	$result;

	if ($num_results > 0){ 
		$result = "{\"response\":\"unavailable\"}";
	}else{
		$result = "{\"response\":\"available\"}";
	}

	echo json_encode($result);
?>