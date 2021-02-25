<?php
$query = "SELECT tier.tiername, tierart.tierart, revier.reviername, gehege.gehege FROM tier, tierart, revier, gehege WHERE t_id NOT IN (SELECT t_id from fuetterung) AND tierart.art_id=tier.art_id AND revier.r_id=tier.r_id AND gehege.g_id=tier.g_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gehege[] = $row['gehege'];
  $tiername[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $revier[] = $row['reviername'];
}

echo"<h2>Welche Tiere erhalten kein Futter?</h2>";
echo"<table class='table'><tr><th scope='col'>Nr.</th><th>Tiername</th><th>Tierart</th><th>Revier</th><th>Gehege</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$tiername[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo"</tr>";
}
echo"</table>";