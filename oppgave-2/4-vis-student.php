<?php
/* vis-student.php
   Programmet skriver ut alle registrerte studenter fra databasen.
*/

include("db-tilkobling.php");  // Kobler til database-serveren og velger databasen
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Vis alle studenter</title>
</head>
<body>

<h3>Registrerte studenter</h3>

<?php
/* SQL-setning som henter alle studenter, sortert etter brukernavn */
$sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";

/* Sender SQL-setningen til databasen og lagrer resultatet */
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

/* Teller antall rader (studenter) som ble hentet */
$antallRader = mysqli_num_rows($sqlResultat);

/* Sjekker om det finnes registrerte studenter */
if ($antallRader == 0) {
  print("Ingen studenter er registrert i databasen.");
} 
else {
  /* Skriver ut en HTML-tabell med kolonneoverskrifter */
  print("<table border='1'>");
  print("<tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>");

  /* For løkke som henter en og en student fra resultatet og skriver dem ut */
  for ($r = 1; $r <= $antallRader; $r++) {
    $rad = mysqli_fetch_array($sqlResultat);  // Henter én rad (én student)
    $brukernavn = $rad["brukernavn"];         // Leser brukernavn
    $fornavn = $rad["fornavn"];               // Leser fornavn
    $etternavn = $rad["etternavn"];           // Leser etternavn
    $klassekode = $rad["klassekode"];         // Leser klassekode (kobling til klasse-tabellen)

    /* Skriver ut verdiene som én rad i tabellen */
    print("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>");
  }

  /* Avslutter HTML-tabellen */
  print("</table>");
}
?>

</body>
</html>
