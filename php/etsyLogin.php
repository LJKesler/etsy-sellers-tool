<?php
require 'oauth.inc.php';
require 'db.inc.php';

	$result;
	$uname = $_POST['new_username'];
	$pwd = $_POST['new_password'];
	$query = "insert into registered_users (username, password) values ('". $uname . "','" . $pwd . "')";
	$queryResult = mysqli_query($link, $query);

	try {
	   	$oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);
	   	$req_token = $oauth->getRequestToken("http://sandbox.openapi.etsy.com/v2/oauth/request_token?scope=email_r",'http://www.leighkesler.com/etsysellers/etsyLogin_step2.php');
	   	
		setcookie("requestTokenSecret", $req_token['oauth_token_secret']);
		
	   	$result = "{\"response\": \"" . $req_token['login_url'] . "\"}";
	} catch(OAuthException $E) {
	    $result = "{\"response\":\"failure\"}";
	}

	header("Location: " . $req_token['login_url']);
?>