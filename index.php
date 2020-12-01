<?php
include "connection.php";

?>

<html>
<h1>Plegerverwaltung</h1>
<form method="post">
<label>Vorname:</label>
<input type="text" name="vorname" ></input><br>
<label>Nachname: </label>
<input type="text" name="nachname" ></input><br>
<label>Geburtsdatum: </label>
<input type="text" name="gebdat" ></input><br>
<label>Telefonnummer:  </label>
<input type="text" name="telefonnummer" ></input><br>
<label>Adresse: </label>
<input type="text" name="adresse" ></input><br>
<label>PLZ: </label>
<input type="text" name="plz" ></input><br>
<button type="submit" name="speichern" >Speichern</button> 

</form>


</html>

<?php

if (isset($_POST["speichern"]))
{
  $sql = "Insert into pfleger (Vorname, Nachname, Geburtsdatum, Telefonnummer, Adresse, PLZ) values ('".$_POST["vorname"]."','".$_POST["nachname"]."','".$_POST["gebdat"]."','".$_POST["telefonnummer"]."','".$_POST["adresse"]."', '".$_POST["plz"]."')";

}

if ($conn->query($sql) == FALSE)
{
  echo "Fehler beim Einfügen: " . $conn->error;
}




?>