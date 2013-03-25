<?php
require 'oauth.inc.php';
require 'db.inc.php';

	$request_token = $_GET['oauth_token'];
	$request_token_secret = $_COOKIE['requestTokenSecret'];
	$oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET);
	$oauth->disableSSLChecks();
	$oauth->setToken($request_token, $request_token_secret);

	$verifier = $_GET['oauth_verifier'];

	try {
	    $acc_token = $oauth->getAccessToken("https://sandbox.openapi.etsy.com/v2/oauth/access_token", null, $verifier);
	    $access_token_secret = $acc_token['oauth_token_secret'];
	    $access_token = $acc_token['oauth_token'];
	    
	    //TODO :: Persist to db;
	
	} catch (OAuthException $e) {
	    error_log($e->getMessage());
	    error_log(print_r($oauth->getLastResponse(), true));
	    error_log(print_r($oauth->getLastResponseInfo(), true));
	    exit;
	}

    $oauthStep3 = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
	$oauthStep3->setToken($access_token, $access_token_secret);

try {
    $data = $oauth->fetch("https://sandbox.openapi.etsy.com/v2/oauth/scopes", null, OAUTH_HTTP_METHOD_GET);
    $json = $oauth->getLastResponse();
    print_r(json_decode($json, true));
    
} catch (OAuthException $e) {
    error_log($e->getMessage());
    error_log(print_r($oauth->getLastResponse(), true));
    error_log(print_r($oauth->getLastResponseInfo(), true));
    print "\nERROR :: " . $e->getMessage() . "\n";
    print "\nlast response :: " . $oauth->getLastResponse();
    exit;
}

?>