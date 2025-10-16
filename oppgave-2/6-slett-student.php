<?php
/* slett-student.php
   Programmet lar brukeren velge en student og slette den fra databasen.
*/

include("db-tilkobling.php");  // Kobler til database-serveren og velger riktig database
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8"> 
  <title>Slett student</title>
</head>
<body>

<h3>Slett student</h3>

<!-- Skjema for å velge hvilken student som skal slettes -->
<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema">
  Velg student:
  <select name="brukernavn" id="brukernavn">
    <option value="">-- Velg student --</option>
    <?php
      /* Henter alle registrerte studenter slik at de vises i nedtrekkslisten */
      $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente studenter fra databasen.");

      $antallRader = mysqli_num_rows($sqlResultat);

      /* Legger hver student som et valg i listen */
      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];

        print("<option value='$brukernavn'>$brukernavn - $fornavn $etternavn</option>");
      }
    ?>
  </select>
  <br><br>

  <!-- Knapp for å slette valgt student -->
  <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp">
</form>

<?php
/* PHP kode som kjøres når brukeren trykker på "Slett student"-knappen */
if (isset($_POST["slettStudentKnapp"])) {
  $brukernavn = $_POST["brukernavn"];

  if (!$brukernavn) {
    print("Du må velge en student for å slette.");
  } 
  else {
    /* Sjekker om studenten faktisk finnes i databasen */
    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) == 0) {
      print("Studenten finnes ikke i databasen.");
    } 
    else {
      /* Sletter studenten */
      $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";
      mysqli_query($db, $sqlSetning) or die("Feil ved sletting.");

      print("Studenten med brukernavn <b>$brukernavn</b> er slettet.");
    }
  }
}
?>

</body>
</html>
