<?php
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'etsysellertools');
define('DB_USERS', 'registered_users');
$link = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);		

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
