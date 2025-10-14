<?php
/* student-registrer.php
   Programmet lar brukeren registrere en ny student i databasen.
*/
include("db-tilkobling.php");  // kobler til databasen
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer student</title>
</head>
<body>

<h3>Registrer student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>

  Klassekode:
  <select name="klassekode" id="klassekode">
    <option value="">-- Velg klasse --</option>
    <?php
      $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente klasser fra databasen");
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

  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
  <input type="reset" value="Nullstill" />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"])) {
  $brukernavn = $_POST["brukernavn"];
  $fornavn = $_POST["fornavn"];
  $etternavn = $_POST["etternavn"];
  $klassekode = $_POST["klassekode"];

  if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
    print("Alle felt må fylles ut.");
  } else {
    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) != 0) {
      print("Brukernavnet $brukernavn er allerede registrert.");
    } else {
      $sqlSetning = "INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
      mysqli_query($db, $sqlSetning) or die("Feil ved registrering av data.");
      print("Studenten $fornavn $etternavn ($brukernavn) er nå registrert i klasse $klassekode.");
    }
  }
}
?>

</body>
</html>
