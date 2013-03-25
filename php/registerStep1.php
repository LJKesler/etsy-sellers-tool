<?php
	require 'db.inc.php';

	$username = $_GET['new_username'];
	$password = $_GET['new_password'];

	$query = "SELECT * FROM registered_users where username = '". $username . "'";
	$queryResult = mysqli_query($link, $query);
	$num_results = mysqli_num_rows($queryResult); 
	$result;

	if ($num_results > 0){ 
		$result = array('response' => 'username unavailable');
	}else{
		$insertQuery = "INSERT INTO registered_users (username, password) VALUES ('". $username . "','" . $password . "' )";
		$insertQueryResult = mysqli_query($link, $insertQuery);
		if($insertQueryResult == 1){
			$result = array('response' => 'success');
		}else{
			$result = array('response' => 'username unavailable');
		}
	}

	echo json_encode($result);
?>