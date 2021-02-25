<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1 class='mb-3'>Extras</h1>";

include "9uhr.php";
include "wievieletiere.php";
include "wievielfutter.php";
include "welchetierebetreut.php";
include "welchetiereerhalten.php";
include "welchegehegebetreut.php";
include "wiesiehtderfutterplan.php";

echo "</div>";


?>
