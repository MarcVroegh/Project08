<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten6($_SESSION["hekkensluiterFunctie"]);
if ($result['aanmaken'] == 1) {
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
    header("Refresh:0; url=/Project08/pages/BeheermoduleApplicatie.php");
}
?>
<!DOCTYPE html>
<html>
<title>Actiepaneel aanmaken</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="./BeheermoduleApplicatie.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Snelle acties</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<div class="align">
<h1>Aanmaken functies</h1>

<form action="/project08/pages/aanmaken.php" method="post" enctype="multipart/form-data">
  <input type="text" name="functie" placeholder="Naam functie"><br>
  <input type="text" name="rolid" placeholder="Nummer die u er aan wilt koppelen (rol_id)"><br>
  <input type="submit" value="submit" name="submit">
  <p><?php if(isset($_SESSION["status40"])) { echo $_SESSION["status40"]; unset($_SESSION["status40"]); } ?></p>
</form>
</div>
</div>
<div class="con2">
<h1>Aanmaken medewerker</h1>

<form action="/project08/pages/aanmaken.php" method="post" enctype="multipart/form-data">
  <input type="text" name="naam" placeholder="Naam"><br>
  <input type="text" name="achternaam" placeholder="Achternaam"><br>
  <input type="text" name="functie" placeholder="Functie"><br>
  <input type="text" name="rolid" placeholder="Rol_id"><br>
  <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam"><br>
  <input type="text" name="wachtwoord" placeholder="Wachtwoord"><br>
  <input type="submit" value="submit" name="submit3">
  <p><?php if(isset($_SESSION["status41"])) { echo $_SESSION["status41"]; unset($_SESSION["status41"]); } ?></p>
</form>
</div>

</body>
</html>

<?php
if (isset($_POST['submit'])){
    $functie=isset($_POST['functie']) ? addslashes($_POST['functie']) : "";
    $rolid=isset($_POST['rolid']) ? addslashes($_POST['rolid']) : "";
   
}
if (isset($_POST['submit'])){
$rol = $fun->SelectFromFuncties($functie);
if($rol == 0) {
    $rol2 = $fun->SelectFromFuncties2($rolid);
    if($rol2 == 0) {
        $rol3 = $fun->InsertIntoFuncties($functie, $rolid);
        if($rol3 == 1) {
            $check40 = $fun->InsertIntoRechten($functie);
            if($check40 == 1) {
              $_SESSION["status40"] = "Succesvol";
              header("Refresh:0; url=aanmaken.php");
            }
            else{
                $_SESSION["status40"] = $check40;
                header("Refresh:0; url=aanmaken.php");
            }
        }
        else{
            $_SESSION["status40"] = "Fout bij toevoegen";
            header("Refresh:0; url=aanmaken.php");
        }
    }
    else{
        $_SESSION["status40"] = "Er bestaat al met deze rol";
        header("Refresh:0; url=aanmaken.php");
    }
}
else{
    $_SESSION["status40"] = "Er bestaat al met deze functie";
    header("Refresh:0; url=aanmaken.php");
}
}


if (isset($_POST['submit3'])){
    $naam=isset($_POST['naam']) ? addslashes($_POST['naam']) : "";
    $achternaam=isset($_POST['achternaam']) ? addslashes($_POST['achternaam']) : "";
    $functie=isset($_POST['functie']) ? addslashes($_POST['functie']) : "";
    $rolid=isset($_POST['rolid']) ? addslashes($_POST['rolid']) : "";
    $gebruiker=isset($_POST['gebruikersnaam']) ? addslashes($_POST['gebruikersnaam']) : "";
    $wachtwoord=isset($_POST['wachtwoord']) ? addslashes($_POST['wachtwoord']) : "";
    $wachtwoord2 = password_hash($wachtwoord, PASSWORD_DEFAULT);
}
if (isset($_POST['submit3'])){
$check25 = $fun->SelectFromGebruiker($gebruiker);
if ($check25 == 0) {
$check20 = $fun->CheckFuncties($rolid);
$check21 = $fun->CheckFuncties2($functie);
if ($functie == $check20['Functie'])
{
    if ($rolid == $check21['rol_id'])
    {
        $check22 = $fun->InsertIntoGebruiker($naam, $achternaam, $functie, $rolid, $gebruiker, $wachtwoord2);
        if ($check22 == 1)
        {
            $_SESSION["status41"] = "Succesvol";
            header("Refresh:0; url=aanmaken.php");
        }
        else{
            $_SESSION["status41"] = "Mislukt bij het toevoegen, probeer opnieuw";
            header("Refresh:0; url=aanmaken.php");
        }
    }
    else{
        $_SESSION["status41"] = "Verkeerde functie bij de rolid, of deze functie is nog niet aangemaakt";
        header("Refresh:0; url=aanmaken.php");
    }
}
else{
    $_SESSION["status41"] =  "Verkeerde functie bij de rolid, of deze functie is nog niet aangemaakt";
    header("Refresh:0; url=aanmaken.php");
}
}
else{
    $_SESSION["status41"] =  "Er bestaat al een gebruiker met deze gebruikersnaam, probeer opnieuw met een andere gebruikersnaam";
    header("Refresh:0; url=aanmaken.php"); 
}
}
?>