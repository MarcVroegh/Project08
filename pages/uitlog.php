<?php
session_start();
unset($_SESSION["hekkensluiter"]);
unset($_SESSION["hekkensluiterNaam"]);
unset($_SESSION["hekkensluiterAchternaam"]);
unset($_SESSION["hekkensluiterGebruikersnaam"]);
session_destroy();
header("Refresh:0; url=/Project08/index.php");
?>