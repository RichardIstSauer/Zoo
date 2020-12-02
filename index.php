<?php
include "connection.php";

?>

<html>

<h1>Pleger hinzufügen</h1>
<form method="post">
<label>Vorname:</label><br>
<input type="text" name="vorname" ></input><br>
<label>Nachname: </label><br>
<input type="text" name="nachname" ></input><br>
<label>Geburtsdatum: </label><br>
<input type="date" name="gebdat" ></input><br>
<label>Telefonnummer:  </label><br>
<input type="text" name="telefonnummer" ></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse" ></input><br>
<label>PLZ: </label><br>
<input type="text" name="plz_pfleger" ></input><br><br>
<button type="submit" name="speichern_pfleger" >Speichern</button> 
</form>

<h1>Ort hinzufügen</h1>
<form method="post">
<label>Ortsname: </label><br>
<input type="text" name="ort" ></input><br>
<label>PLZ: </label><br>
<input type="text" name="plz_ort" ></input><br><br>
<button type="submit" name="speichern_ort" >Speichern</button> 
</form>

<h1>Revier hinzufügen</h1>
<form method="post">
<label>Reviername: </label><br>
<input type="text" name="reviername" ></input><br><br>
<button type="submit" name="speichern_revier" >Speichern</button> 
</form>

<h1>Gebäude hinzufügen</h1>
<form method="post">
<label>Gebäude: </label><br>
<input type="text" name="gebaeudeName" ></input><br><br>
<button type="submit" name="speichern_gebaeude" >Speichern</button> 
</form>

<h1>Gehege hinzufügen</h1>
<form method="post">
<label>Gehege: </label><br>
<input type="text" name="gehegeName" ></input><br>
<button type="submit" name="speichern_gehege" >Speichern</button> 
</form>

<h1>Lieferant hinzufügen</h1>
<form method="post">
<label>Lieferant: </label><br>
<input type="text" name="lieferantname" ></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse_lieferant" ></input><br>
<label>PLZ: </label><br>
<input type="text" name="plz_lieferant" ></input><br>
<label>Ansprechpartner: </label><br>
<input type="text" name="ansprechpartner" ></input><br><br>
<button type="submit" name="speichern_lieferant" >Speichern</button> 
</form>






</html>

<?php

if (isset($_POST["speichern_pfleger"]))
{
  $sql = "Insert into pfleger (Vorname, Nachname, Geburtsdatum, Telefonnummer, Adresse, PLZ) values ('".$_POST["vorname"]."','".$_POST["nachname"]."','".$_POST["gebdat"]."','".$_POST["telefonnummer"]."','".$_POST["adresse"]."', '".$_POST["plz_pfleger"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

if (isset($_POST["speichern_ort"]))
{
  $sql = "Insert into ort (Ort, PLZ) values ('".$_POST["ort"]."','".$_POST["plz_ort"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

if (isset($_POST["speichern_revier"]))
{
  $sql = "Insert into revier (Revier) values ('".$_POST["reviername"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

if (isset($_POST["speichern_lieferant"]))
{
  $sql = "Insert into lieferant (Lieferant, Adresse, PLZ, Ansprechpartner) values ('".$_POST["lieferantname"]."', '".$_POST["adresse_lieferant"]."', '".$_POST["plz_lieferant"]."', '".$_POST["ansprechpartner"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

if (isset($_POST["speichern_gebaeude"]))
{
  $sql = "Insert into lieferant (Lieferant, Adresse, PLZ, Ansprechpartner) values ('".$_POST["lieferantname"]."', '".$_POST["adresse_lieferant"]."', '".$_POST["plz_lieferant"]."', '".$_POST["ansprechpartner"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

if (isset($_POST["speichern_gehege"]))
{
  $sql = "Insert into lieferant (Lieferant, Adresse, PLZ, Ansprechpartner) values ('".$_POST["lieferantname"]."', '".$_POST["adresse_lieferant"]."', '".$_POST["plz_lieferant"]."', '".$_POST["ansprechpartner"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}






?>