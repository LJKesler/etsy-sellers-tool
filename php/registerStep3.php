<?php
	require 'env.inc.php';
	require 'oauth.inc.php';
	require 'db.inc.php';
	require 'url.inc.php';
	
	$request_token = $_GET['oauth_token'];
	$request_token_secret = $_COOKIE['requestTokenSecret'];

	$oauthStep2 = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);

	$oauthStep2->setToken($request_token, $request_token_secret);

	$verifier = $_GET['oauth_verifier'];

	$access_token_secret;
    $access_token;

	try {
	    $acc_token = $oauthStep2->getAccessToken(ETSY_URL . "/oauth/access_token", null, $verifier);
	    $access_token_secret = $acc_token['oauth_token_secret'];
	    $access_token = $acc_token['oauth_token'];

	    $username = $_COOKIE['user'];
	    $query = "UPDATE registered_users SET accessToken='".$access_token."', accessTokenSecret='" . $access_token_secret . "' where username = '". $username."';";
	    $link->query($query);

	    header("Location: " . SITE_BASE_URL . "/main.html");
	    exit;
	} catch (OAuthException $e) {
	    error_log($e->getMessage());
	    error_log(print_r($oauthStep2->getLastResponse(), true));
	    error_log(print_r($oauthStep2->getLastResponseInfo(), true));
	}
	
?>
