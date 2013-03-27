<?php
    require 'url.inc.php';
    require 'oauth.inc.php';
    require 'db.inc.php';

    $result;
    $url = ETSY_SANDBOX_URL . $_GET['apiUrl'];
 
    $username = $_GET['user'];

    $actQuery = "SELECT accessToken FROM registered_users where username = '". $username . "'";
    $access_token_result = $link->query($actQuery);
    $row = $access_token_result->fetch_assoc();
    $access_token = $row['accessToken'];
    
    $actsQuery = "SELECT accessTokenSecret FROM registered_users where username = '". $username . "'";
    $access_token_secret_result = $link->query($actsQuery);
    $row = $access_token_secret_result->fetch_assoc();
    $access_token_secret = $row['accessTokenSecret'];
   
    $oauth = new OAuth(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
    $oauth->setToken($access_token, $access_token_secret);

    try {
        $data = $oauth->fetch($url, null, OAUTH_HTTP_METHOD_GET);
        $json = $oauth->getLastResponse();
        $result = array('response' => json_decode($json, true) );
     
    } catch (OAuthException $e) {
        error_log("Error :: \n");
        error_log($e->getMessage());
        error_log(print_r($oauth->getLastResponse(), true));
        error_log(print_r($oauth->getLastResponseInfo(), true));
        $result = array('response' => 'error' );
    }

    echo json_encode($result);

?>
