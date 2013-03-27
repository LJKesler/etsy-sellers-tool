<?php
	require 'env.inc.php';
	require 'db.inc.php';

	$username = $_GET['new_username'];
	$password = $_GET['new_password'];

	$query = "SELECT * FROM registered_users where username = '". $username . "'";
	$queryResult = $link->query($query);
	$num_results = $queryResult->num_rows(); 

	$result;

	if ($num_results > 0){ 
		$result = array('response' => 'username unavailable');
	}else{
		$insertQuery = "INSERT INTO registered_users (username, password) VALUES ('". $username . "','" . $password . "' )";
		$insertQueryResult = $link->query($insertQuery);
		setcookie("user", $username);
		
		if($insertQueryResult == 1){
			$result = array('response' => 'success');
		}else{
			$result = array('response' => 'username unavailable');
		}
	}
	echo json_encode($result);
?>