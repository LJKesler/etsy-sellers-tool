<?php
define('DB_HOSTNAME', 'mysql.leighkelser.com');
define('DB_USERNAME', 'etsy_seller_app');
define('DB_PASSWORD', '3tsys3ll3r');
define('DB_NAME', 'etsysellertools');
define('DB_USERS', 'registered_users');
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);  	

if (mysqli_connect_errno($link)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
