<?php /* Eksempel 2 */
/*
/*    Programmet mottar 2 tall fra et HTML-skjema ved POST-metoden
/*    Programmet skriver ut de 2 tallene og summen og differansen av/mellom tallene
*/

$tall=$_POST ["tall1"];
$tall=$_POST ["tall2"];

$summen=$tall + $tall2;
$differanse=$tall - $tall2;

print ("Tall 1 er $tall <br />");
print ("Tall 2 er $tall <br />");
print ("Summen er $summen <br />");
print ("Differansen er $differansen <br />");
?>