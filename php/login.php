<?php
	require 'env.inc.php';
	require 'db.inc.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM registered_users where username = '". $username . "' AND password = '" . $password . "'";
	$queryResult = mysqli_query($link, $query);
	$num_results = mysqli_num_rows($queryResult);

	if($num_results == 1){
		$result = array('response' => 'success');
	} else {
		$result = array('response' => 'failure');
	}

	echo json_encode($result);
?>