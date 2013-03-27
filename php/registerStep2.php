<?php
require 'oauth.inc.php';

	$result;

	try {
	   	$oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);
	   	$req_token = $oauth->getRequestToken("http://sandbox.openapi.etsy.com/v2/oauth/request_token",CALLBACK_URL);
	   	
		setcookie("requestTokenSecret", $req_token['oauth_token_secret']);
		
	   	$result = array('response' => $req_token['login_url'] );
	} catch(OAuthException $E) {
	    $result = array('response' => 'failure');
	}
	echo json_encode($result);
?>