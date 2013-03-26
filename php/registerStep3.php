<?php
require 'oauth.inc.php';
require 'db.inc.php';

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
	
	} catch (OAuthException $e) {
		error_log('Step 2 exception');
	    error_log($e->getMessage());
	    error_log(print_r($oauthStep2->getLastResponse(), true));
	    error_log(print_r($oauthStep2->getLastResponseInfo(), true));
	    exit;
	}

    $oauthStep3 = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
    $oauthStep3->setToken($access_token, $access_token_secret);

try {
    $data = $oauthStep3->fetch("http://sandbox.openapi.etsy.com/v2/users/__SELF__", null, OAUTH_HTTP_METHOD_GET);
    $json = $oauthStep3->getLastResponse();
    print_r(json_decode($json, true));
    
} catch (OAuthException $e) {
	error_log("Step 3 Error :: \n");
    error_log($e->getMessage());
    error_log(print_r($oauthStep3->getLastResponse(), true));
    error_log(print_r($oauthStep3->getLastResponseInfo(), true));
    print "\nERROR :: " . $e->getMessage() . "\n";
    print "\nlast response :: " . $oauthStep3->getLastResponse();
    exit;
}

?>
