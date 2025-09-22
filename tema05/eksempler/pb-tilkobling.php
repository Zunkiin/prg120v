<?php  /* pb-tilkobling */
/*
/*  Programmet foretar tilkobling til database-server og valg av database
*/
$host = getenv('paber2152_HOST');
$username = getenv('paber2152_USER');
$password = getenv('paber2152_PASSWORD');
$database = getenv('paber2152_DATABASE');

 $paber2152=mysqli_connect($host,$username,$password,$database) or die ("ikke kontakt med database-server");
    /* tilkobling til database-serveren utført */
 ?>