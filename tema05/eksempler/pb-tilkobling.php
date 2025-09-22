<?php
/* pb-tilkobling */
/*
/* Programmet foretar tilkobling til database-server og valg av database
*/
$host = getenv('PB_HOST');
$username = getenv('PB_USER');
$password = getenv('PB_PASSWORD');
$database = getenv('PB_DATABASE');

// Force the connection to use TCP/IP by specifying the port
$port = 3306; // Default MySQL/MariaDB port

// The sixth parameter is the socket. Set it to null to force TCP/IP.
$pb = mysqli_connect($host, $username, $password, $database, $port) or die("ikke kontakt med database-server");

/* tilkobling til database-serveren utført */
?>