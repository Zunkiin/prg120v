<?php  
/* registrer-klasse.php
   Programmet lager et HTML-skjema for å registrere en klasse.
   Programmet registrerer data (klassekode, klassenavn, studiumkode) i databasen.
*/
?> 

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer klasse</title>
</head>
<body>

<h3>Registrer klasse</h3>

<!-- HTML-skjema for å registrere en ny klasse -->
<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  Klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
  Studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
  
  <!-- Knapper for å sende inn eller nullstille skjemaet -->
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
/* PHP-koden under kjøres når brukeren trykker på "Registrer klasse"-knappen */
if (isset($_POST["registrerKlasseKnapp"]))
{
    /* Henter dataene brukeren skrev inn i skjemaet */
    $klassekode = $_POST["klassekode"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];

    /* Sjekker om alle feltene er fylt ut */
    if (!$klassekode || !$klassenavn || !$studiumkode)
    {
        print("Alle felt må fylles ut");
    }
    else
    {
        include("db-tilkobling.php");  // Kobler til database-serveren og velger riktig database

        /* Sjekker om klassen allerede finnes i databasen */
        $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0)  // Klassen finnes allerede
        {
            print("Klassen med kode $klassekode er registrert fra før");
        }
        else
        {
            /* Klassen finnes ikke → registrerer ny klasse */
            $sqlSetning = "INSERT INTO klasse VALUES('$klassekode','$klassenavn','$studiumkode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");
            
            print("Følgende klasse er nå registrert: $klassekode $klassenavn $studiumkode");
        }
    }
}
?> 

</body>
</html>
