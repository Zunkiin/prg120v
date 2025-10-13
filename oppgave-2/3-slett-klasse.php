<?php
/* slett-klasse.php
   Programmet lar brukeren velge en klasse og sletter den fra databasen.
*/
include("db-tilkobling.php");  // kobler til databasen
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Slett klasse</title>
</head>
<body>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema">
  Velg klassekode:
  <select name="klassekode" id="klassekode">
    <option value="">-- Velg klasse --</option>
    <?php
      // Henter alle klasser fra databasen for nedtrekkslisten
      $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

      $antallRader = mysqli_num_rows($sqlResultat);
      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        print("<option value='$klassekode'>$klassekode - $klassenavn</option>");
      }
    ?>
  </select>
  <br><br>

  <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp">
</form>

<?php
if (isset($_POST["slettKlasseKnapp"])) {
  $klassekode = $_POST["klassekode"];

  if (!$klassekode) {
    print("Du må velge en klasse for å slette.");
  } else {
    // Sjekk om klassen finnes
    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) == 0) {
      print("Klassen finnes ikke i databasen.");
    } else {
      // Slett klassen
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      mysqli_query($db, $sqlSetning) or die("Feil ved sletting.");

      print("Klassen med kode $klassekode er slettet.");
    }
  }
}
?>

</body>
</html>
