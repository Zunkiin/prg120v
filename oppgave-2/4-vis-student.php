<?php
/* vis-student.php
   Programmet skriver ut alle registrerte studenter
*/
include("db-tilkobling.php");  // kobler til databasen
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
$sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

if ($antallRader == 0) {
  print("Ingen studenter er registrert i databasen.");
} else {
  print("<table border='1'>");
  print("<tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>");

  for ($r = 1; $r <= $antallRader; $r++) {
    $rad = mysqli_fetch_array($sqlResultat);
    $brukernavn = $rad["brukernavn"];
    $fornavn = $rad["fornavn"];
    $etternavn = $rad["etternavn"];
    $klassekode = $rad["klassekode"];

    print("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>");
  }
  print("</table>");
}
?>

</body>
</html>
