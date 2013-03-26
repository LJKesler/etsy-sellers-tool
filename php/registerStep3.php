<?php
	require 'oauth.inc.php';
	require 'db.inc.php';
	require 'url.inc.php';
	
	$baseURL;
	switch (ENV){
		case "\"DEV\"":
			$baseURL = SITE_DEV_BASE_URL;
			break;
		case "\"LOCAL\"":
			$baseURL = SITE_LOCAL_BASE_URL;
			break
		case "\"PROD\"":
			$baseURL = SITE_PROD_BASE_URL:
			break;
	}

	$request_token = $_GET['oauth_token'];
	$request_token_secret = $_COOKIE['requestTokenSecret'];

	$oauthStep2 = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);

	$oauthStep2->setToken($request_token, $request_token_secret);

	$verifier = $_GET['oauth_verifier'];

	$access_token_secret;
    	$access_token;

	try {
	    $acc_token = $oauthStep2->getAccessToken("http://sandbox.openapi.etsy.com/v2/oauth/access_token", null, $verifier);
	    $access_token_secret = $acc_token['oauth_token_secret'];
	    $access_token = $acc_token['oauth_token'];

	    $username = $_COOKIE['user'];
	    $query = "UPDATE registered_users SET accessToken='".$access_token."', accessTokenSecret='" . $access_token_secret . "' where username = '". $username."';";
	    $insertTokenQueryResult = mysqli_query($link, $query);
	    header("Location: " . $baseURL . "/main.html");
	    exit;
	} catch (OAuthException $e) {
	    error_log($e->getMessage());
	    error_log(print_r($oauthStep2->getLastResponse(), true));
	    error_log(print_r($oauthStep2->getLastResponseInfo(), true));
	}
	
?>
