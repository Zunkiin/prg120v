<?php
/* slett-student.php
   Programmet lar brukeren velge en student og slette den fra databasen.
*/
include("db-tilkobling.php");  // kobler til databasen
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Slett student</title>
</head>
<body>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema">
  Velg student:
  <select name="brukernavn" id="brukernavn">
    <option value="">-- Velg student --</option>
    <?php
      $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente studenter fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat);
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

  <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp">
</form>

<?php
if (isset($_POST["slettStudentKnapp"])) {
  $brukernavn = $_POST["brukernavn"];

  if (!$brukernavn) {
    print("Du må velge en student for å slette.");
  } else {
    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Feil ved henting av data.");

    if (mysqli_num_rows($sqlResultat) == 0) {
      print("Studenten finnes ikke i databasen.");
    } else {
      $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";
      mysqli_query($db, $sqlSetning) or die("Feil ved sletting.");
      print("Studenten med brukernavn $brukernavn er slettet.");
    }
  }
}
?>

</body>
</html>
