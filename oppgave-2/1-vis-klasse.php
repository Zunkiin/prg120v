<?php
/* vis-klasse.php
   Programmet skriver ut alle registrerte klasser
*/
include("db-tilkobling.php");  // kobler til databasen
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
$sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

if ($antallRader == 0) {
  print("Ingen klasser er registrert i databasen.");
} else {
  print("<table border='1'>");
  print("<tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>");

  for ($r = 1; $r <= $antallRader; $r++) {
    $rad = mysqli_fetch_array($sqlResultat);
    $klassekode = $rad["klassekode"];
    $klassenavn = $rad["klassenavn"];
    $studiumkode = $rad["studiumkode"];

    print("<tr><td>$klassekode</td><td>$klassenavn</td><td>$studiumkode</td></tr>");
  }
  print("</table>");
}
?>

</body>
</html>
