<?php
switch (ENV){
	case "\"DEV\"":
		define('SITE_BASE_URL',   'http://leighkesler.com/etsydev');
		define('CALLBACK_URL',   'http://leighkesler.com/etsydev/php/registerStep3.php');
		define('ETSY_URL' , 'http://sandbox.openapi.etsy.com/v2');
		break;
	case "\"LOCAL\"":
		define('SITE_BASE_URL', 'http://localhost:8888');
		define('CALLBACK_URL', 'http://localhost:8888/php/registerStep3.php');
		define('ETSY_SANDBOX_URL' , 'http://sandbox.openapi.etsy.com/v2');
		break
	case "\"PROD\"":
		define('SITE_BASE_URL',  'http://leighkesler.com/etsysellers');
		define('CALLBACK_URL',  'http://leighkesler.com/etsysellers/php/registerStep3.php');
		define('ETSY_URL' , 'http://openapi.etsy.com/v2');
		break;
}