<?php
/* student-registrer.php
   Programmet lar brukeren registrere en ny student i databasen.
*/

include("db-tilkobling.php");  // Kobler til database-serveren og velger riktig database
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer student</title>
</head>
<body>

<h3>Registrer student</h3>

<!-- HTML-skjema for å registrere ny student -->
<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>

  <!-- Nedtrekksliste for å velge klasse -->
  Klassekode:
  <select name="klassekode" id="klassekode">
    <option value="">-- Velg klasse --</option>
    <?php
      /* Henter alle klasser fra databasen slik at brukeren kan velge riktig klasse */
      $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klasser fra databasen");

      $antallRader = mysqli_num_rows($sqlResultat);  // Teller antall klasser som ble funnet

      /* For løkke som legger hver klasse inn som et valg (<option>) i nedtrekkslisten */
      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);  // Henter én rad (én klasse)
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        print("<option value='$klassekode'>$klassekode - $klassenavn</option>");
      }
    ?>
  </select>
  <br><br>

  <!-- Knapper for å sende inn eller nullstille skjemaet -->
  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" />
</form>

<?php
/* PHP-koden under kjøres når brukeren trykker på "Registrer student"-knappen */
if (isset($_POST["registrerStudentKnapp"])) {

  /* Henter verdiene brukeren har skrevet inn i skjemaet */
  $brukernavn = $_POST["brukernavn"];
  $fornavn = $_POST["fornavn"];
  $etternavn = $_POST["etternavn"];
  $klassekode = $_POST["klassekode"];

  /* Sjekker at alle felt er fylt ut */
  if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
    print("Alle felt må fylles ut.");
  } 
  else {
    /* Sjekker om brukernavnet allerede finnes i databasen */
    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) != 0) {
      /* Brukernavn finnes allerede */
      print("Brukernavnet $brukernavn er allerede registrert.");
    } 
    else {
      /* Brukernavn finnes ikke → registrerer ny student */
      $sqlSetning = "INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
      mysqli_query($db, $sqlSetning) or die("Feil ved registrering av data.");

      /* Bekreftelse til brukeren */
      print("Studenten $fornavn $etternavn ($brukernavn) er nå registrert i klasse $klassekode.");
    }
  }
}
?>

</body>
</html>
