<?php

switch (ENV){
	case "\"DEV\"":
		define('DB_HOSTNAME', 'mysql.leighkelser.com');
		define('DB_USERNAME', 'etsy_seller_app');
		define('DB_PASSWORD', '3tsys3ll3r');
		break;
	case "\"LOCAL\"":
		define('DB_HOSTNAME', 'localhost');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', 'root');
		break
	case "\"PROD\"":
		define('DB_HOSTNAME', 'mysql.leighkelser.com');
		define('DB_USERNAME', 'etsy_seller_app');
		define('DB_PASSWORD', '3tsys3ll3r');
		break;
}
define('DB_NAME', 'etsysellertools');
define('DB_USERS', 'registered_users');

$link = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);		

if (mysqli_connect_errno()){
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
