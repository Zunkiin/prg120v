<?php include 'db-tilkobling.php'; ?>

<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Registrer klasse</title>
</head>
<body>
  <h2>Registrer ny klasse</h2>

  <form method="post">
    Klassekode: <input type="text" name="klassekode" required><br>
    Klassenavn: <input type="text" name="klassenavn" required><br>
    Studiumkode: <input type="text" name="studiumkode" required><br>
    <input type="submit" name="lagre" value="Lagre">
  </form>

  <?php
  if (isset($_POST['lagre'])) {
      $klassekode = $_POST['klassekode'];
      $klassenavn = $_POST['klassenavn'];
      $studiumkode = $_POST['studiumkode'];

      $sql = "INSERT INTO klasse VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
      if ($conn->query($sql)) {
          echo "<p>Klassen ble registrert!</p>";
      } else {
          echo "<p>Feil: " . $conn->error . "</p>";
      }
  }
  ?>
</body>
</html>
