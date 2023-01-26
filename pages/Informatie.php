<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");

$con = new dbh();
$fun = new Functions();

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

if (isset($_POST['submit'])){
    $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
}


$check1 = $fun->CheckIfExistGedetineerde($bsn);
if($check1 == 1) {
    $check2 = $fun->SelectFromGedetineerdePG($bsn);
    $_SESSION["Naam"] = $check2['Naam'];
    $_SESSION["Achternaam"] = $check2['Achternaam'];
    $_SESSION["Huisadres"] = $check2['Huisadres'];
    $_SESSION["Woonplaats"] = $check2['Woonplaats'];
    $_SESSION["Zaaknummer"] = $check2['Zaaknummer'];
    $_SESSION["BSNnummer"] = $check2['BSNnummer'];
    $_SESSION["Celnummer"] = $check2['Celnummer'];
    $_SESSION["Datumarrestatie"] = $check2['Datumarrestatie'];
    $_SESSION["Datumuitbewaring"] = $check2['Datumuitbewaring'];
    $_SESSION["Redenhechtenis"] = $check2['Redenhechtenis'];
    $_SESSION["Aantekeningengedrag"] = $check2['Aantekeningengedrag'];
    $_SESSION["Getuigenverklaring"] = $check2['Getuigenverklaring'];
    if (isset($_SESSION['Getuigenverklaring'])){

    }
    else{
        $_SESSION["status20"] = "Fout bij het inladen van de persoons gegevens";
        header("Refresh:5; url=InformatiePaneel.php");
    }
}
else{
    $_SESSION["status20"] = "De gedetineerde waarvan u informatie wilt opvragen bestaat niet";
    header("Refresh:5; url=InformatiePaneel.php");
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

<div class="con" style="">
<div class="con2">
<?php
$c = $fun->RetrieveFromImageGedetineede($_SESSION["BSNnummer"]); ?>
<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($c['imageg']); ?>" style="width: 200px; height: 200px;" /> 
<p><?php echo $_SESSION["Naam"]; ?> 
<?php echo $_SESSION["Achternaam"]; ?> 
</p>
</div>
<div class="con2">
<p> Huisadres: <?php echo $_SESSION["Huisadres"]; ?> <br>
Woonplaats: <?php echo $_SESSION["Woonplaats"]; ?> <br><br>
Zaaknummer: <?php echo $_SESSION["Zaaknummer"]; ?> <br>
BSN: <?php echo $_SESSION["BSNnummer"]; ?> <br>
Celnummer: <?php echo $_SESSION["Celnummer"]; ?> <br>
Datum van arrestatie: <?php echo $_SESSION["Datumarrestatie"]; ?> <br>
Datum uit bewaring: <?php echo $_SESSION["Datumuitbewaring"]; ?> <br>
Reden van hechtenis: <?php echo $_SESSION["Redenhechtenis"]; ?> <br>
Aantekeningen gedrag: <?php echo $_SESSION["Aantekeningengedrag"]; ?> <br>
Verklaring van getuigen: <?php echo $_SESSION["Getuigenverklaring"]; ?> <br>
</p>
</div>
</div>
</div>
<div class="con2">
<h1>Bezoeker</h1>
<div class="con2">
<h2>Persoonsgegevens</h2>
<table style="width:100%;table-layout:fixed;text-align:left;color:white; font-family: 'Open Sans', sans-serif;">
<thead>
<th>Naam</th>
<th>Achternaam</th>
<th>Huisadres</th>
<th>Woonplaats</th>
<th>BSNnummer</th>
<thead>
<tbody>
<?php
$check5 = $fun->SelectFromBezoekerGebouw2($bsn);
$_SESSION["BSN"] = $check5['BSN'];
$check5 = $fun->SelectFromBezoekerPG($_SESSION["BSN"]);
foreach ($check5 as $check5) {
    echo '<tr>';
    echo '<td>'.$check5['Naam'].'</td>';
    echo '<td>'.$check5['Achternaam'].'</td>';
    echo '<td>'.$check5['Huisadres'].'</td>';
    echo '<td>'.$check5['Woonplaats'].'</td>';
    echo '<td>'.$check5['BSNnummer'].'</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
<div class="con2">
<h2>Bezoekgeschiedenis</h2>
<table style="width:100%;table-layout:fixed;text-align:left;color:white; font-family: 'Open Sans', sans-serif;">
<thead>
<th>BSN</th>
<th>Datum</th>
<th>Tijd in</th>
<th>Tijd uit</th>
<th>Wie bezocht</th>
<thead>
<tbody>
<?php
$check4 = $fun->SelectFromBezoekerGebouw($bsn);
foreach ($check4 as $check4) {
    echo '<tr>';
    echo '<td>'.$check4['BSN'].'</td>';
    echo '<td>'.$check4['Datum'].'</td>';
    echo '<td>'.$check4['Tijdin'].'</td>';
    echo '<td>'.$check4['Tijduit'].'</td>';
    echo '<td>'.$check4['Wiebezocht'].'</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
</div>
<div class="con2">
<h1>Celverplaatsingen</h1>
<div class="con2">
</tbody>
</table>
<table style="width:50%;table-layout:fixed;text-align:left;color:white; font-family: 'Open Sans', sans-serif;">
<thead>
<th>Oude cel</th>
<th>Nieuwe cel</th>
<th>Datum</th>
<thead>
<tbody>
<?php
$check6 = $fun->SelectFromGedetineerdeCel($bsn);
foreach ($check6 as $check6) {
    echo '<tr>';
    echo '<td>'.$check6['Oudecel'].'</td>';
    echo '<td>'.$check6['Nieuwecel'].'</td>';
    echo '<td>'.$check6['Datum'].'</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
</div>
<div class="con2">
<h1>Uploads</h1> <?php
$ch = $fun->SelectFromBewijsMateriaal($_SESSION["BSNnummer"]); ?>
<?php foreach($ch as $row) { 
?> <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['imageh']);?>" style="width: 250px; height:200px;"/> <?php 
} ?>
</div>
      
</body>
</html>