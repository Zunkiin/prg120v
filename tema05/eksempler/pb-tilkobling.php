<?php  /* pb-tilkobling */
/*
/*  Programmet foretar tilkobling til database-server og valg av database
*/
$host = getenv('PB_HOST');
$username = getenv('PB_USER');
$password = getenv('PB_PASSWORD');
$database = getenv('PB_DATABASE');

 $db=mysqli_connect($host,$username,$password,$database) or die ("ikke kontakt med database-server");
    /* tilkobling til database-serveren utført */
 ?>