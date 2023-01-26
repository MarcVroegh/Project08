<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten8($_SESSION["hekkensluiterFunctie"]);
if ($result['celbezetting'] == 1) {
$array2 = $fun->SelectFromLoginLog($_SESSION["hekkensluiterGebruikersnaam"]);
$mysql_timestamp = $array2['thistime'];
if(strtotime($mysql_timestamp) > strtotime("-15 minutes")) {
  if (isset($_SESSION["hekkensluiter"])){
    $fun->InsertIntoLoginLog($_SESSION["hekkensluiterNaam"], $_SESSION["hekkensluiterAchternaam"], $_SESSION["hekkensluiterGebruikersnaam"]);
  }
  else{
    header("Refresh:0; url=/Project08/pages/login.php");
  }
}
else{
  header("Refresh:0; url=/Project08/pages/login.php");
}
}else{
  header("Refresh:0; url=/Project08/pages/HekkensluiterApplicatie.php");
}
?>
<!DOCTYPE html>
<html>
<title>Klantenportaal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="./HekkensluiterApplicatie.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Hekkensluiter</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<h1> Celbezetting </h1>
<br><br><br><br><br><br><br><br><br><br>
<a>Momenteel is cel <?php 
$colors = $fun->SelectCelFromGedetineerdePG();
foreach($colors as $value){
    echo $value['Celnummer'] . " ";
}
?> bezet</a>
<br><br><br><br><br><br><br><br><br><br>

</div>

      
</body>
</html>