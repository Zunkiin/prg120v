<?php
/* pb-tilkobling */
/*
/* Programmet foretar tilkobling til database-server og valg av database
*/
$host = getenv('paber2152_HOST');
$username = getenv('paber2152_USER');
$password = getenv('paber2152_PASSWORD');
$database = getenv('paber2152_DATABASE');

// Force the connection to use TCP/IP by specifying the port
$port = 3306; // Default MySQL/MariaDB port

// The sixth parameter is the socket. Set it to null to force TCP/IP.
$paber2152 = mysqli_connect($host, $username, $password, $database, $port) or die("ikke kontakt med database-server");

/* tilkobling til database-serveren utført */
?>