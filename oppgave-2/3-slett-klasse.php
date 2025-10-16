<?php 
/* slett-klasse.php
   Programmet lar brukeren velge en klasse og slette den fra databasen.
*/
include("db-tilkobling.php");  // Kobler til database-serveren
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Slett klasse</title>
</head>
<body>

<h3>Slett klasse</h3>

<!-- HTML-skjema for å velge klasse som skal slettes -->
<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema">
  Velg klassekode:
  
  <select name="klassekode" id="klassekode">
    <option value="">-- Velg klasse --</option>
    <?php
      /* Henter alle klasser fra databasen for å fylle nedtrekkslisten */
      $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";   // SQL-spørring
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

      $antallRader = mysqli_num_rows($sqlResultat);  // Teller hvor mange klasser som finnes i resultatet

      /* For løkke: henter en og en rad (klasse) og skriver dem ut som <option> i listen */
      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);     // Henter en rad (en klasse)
        $klassekode = $rad["klassekode"];            // Leser klassekode fra raden
        $klassenavn = $rad["klassenavn"];            // Leser klassenavn fra raden
        print("<option value='$klassekode'>$klassekode - $klassenavn</option>"); // Skriver ut valget i listen
      }
    ?>
  </select>
  <br><br>

  <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp">
</form>

<?php
/* PHP-koden under kjøres når brukeren trykker på "Slett klasse"-knappen */
if (isset($_POST["slettKlasseKnapp"])) {  
  $klassekode = $_POST["klassekode"];   // Henter verdien som brukeren valgte fra nedtrekkslisten

  /* Sjekker at brukeren faktisk har valgt en klasse */
  if (!$klassekode) {
    print("Du må velge en klasse for å slette.");
  } 
  else {
    /* Sjekker om klassen finnes i databasen før vi prøver å slette den */
    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) == 0) {  
      // Klassen finnes ikke
      print("Klassen finnes ikke i databasen.");
    } 
    else {
      /* Klassen finnes → vi kan nå slette den */
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      mysqli_query($db, $sqlSetning) or die("Feil ved sletting.");

      print("Klassen med kode $klassekode er slettet.");  // Bekreftelse til brukeren
    }
  }
}
?>

</body>
</html>
