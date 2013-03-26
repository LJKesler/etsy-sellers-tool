<?php
    require 'oauth.inc.php';
    require 'db.inc.php';

    $result;
    $url = $_GET['apiURL'];

    $oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
    $oauth->setToken($access_token, $access_token_secret);

    try {
        $data = $oauth->fetch($url, null, OAUTH_HTTP_METHOD_GET);
        $json = $oauth->getLastResponse();
        $result = array('response' => $json );        
    } catch (OAuthException $e) {
        error_log("Error :: \n");
        error_log($e->getMessage());
        error_log(print_r($oauth->getLastResponse(), true));
        error_log(print_r($oauth->getLastResponseInfo(), true));
        $result = array('response' => 'error' );
    }
?>