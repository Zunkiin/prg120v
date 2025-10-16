<?php
/* vis-klasse.php
   Programmet skriver ut alle registrerte klasser fra databasen.
*/

include("db-tilkobling.php");  // Kobler til database-serveren og velger databasen
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Vis alle klasser</title>
</head>
<body>

<h3>Registrerte klasser</h3>

<?php
/* SQL spørring som henter alle klasser fra tabellen "klasse", sortert etter klassekode */
$sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";

/* Sender spørringen til databasen og lagrer resultatet */
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

/* Teller hvor mange rader (klasser) som ble funnet */
$antallRader = mysqli_num_rows($sqlResultat);

/* Sjekker om databasen inneholder noen klasser */
if ($antallRader == 0) {
  print("Ingen klasser er registrert i databasen.");
} 
else {
  /* Skriver ut overskrifter for tabellen */
  print("<table border='1'>");
  print("<tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>");

  /* For løkke som henter en og en rad fra resultatet og skriver ut verdiene */
  for ($r = 1; $r <= $antallRader; $r++) {
    $rad = mysqli_fetch_array($sqlResultat);   // Henter neste rad (én klasse)
    $klassekode = $rad["klassekode"];          // Leser klassekode
    $klassenavn = $rad["klassenavn"];          // Leser klassenavn
    $studiumkode = $rad["studiumkode"];        // Leser studiumkode

    /* Skriver ut en rad i HTML-tabellen */
    print("<tr><td>$klassekode</td><td>$klassenavn</td><td>$studiumkode</td></tr>");
  }

  /* Avslutter HTML-tabellen */
  print("</table>");
}
?>

</body>
</html>
