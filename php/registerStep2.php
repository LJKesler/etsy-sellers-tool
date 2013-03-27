<?php
require 'env.inc.php';
require 'oauth.inc.php';
require 'db.inc.php';
require 'url.inc.php';

	$result;
	$etsyUserName = $_POST['etsyUsername'];
	$username = $_COOKIE['user'];

	try {

		$query = "UPDATE registered_users SET etsyUsername='".$etsyUserName."' where username = '". $username."';";
	    $link->query($query);

	   	$oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);
	   	$req_token = $oauth->getRequestToken(ETSY_URL . "/oauth/request_token",CALLBACK_URL);
	   	
		setcookie("requestTokenSecret", $req_token['oauth_token_secret']);
		
	   	$result = array('response' => $req_token['login_url'] );
	} catch(OAuthException $E) {
	    $result = array('response' => 'failure');
	}
	echo json_encode($result);
?>