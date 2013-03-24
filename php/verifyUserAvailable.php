<?php
	require 'db.inc.php';

	$username = $_GET['name'];
	$query = "SELECT * FROM registered_users WHERE username =" .$username;
	$queryResult = mysqli_query($link, $query);
	$num_results = mysql_num_rows($queryResult); 
	$result;

	if ($num_results > 0){ 
		$result = "{\"response\":\"available\"}";
	}else{
		$result = "{\"response\":\"unavailable\"}";
	}
	header('Content-Type: application/json');
	echo json_encode($result);
?>