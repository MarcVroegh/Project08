<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten($_SESSION["hekkensluiterFunctie"]);
if ($result['actiegedetineerde'] == 1) {
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
<title>Actiepaneel gedetineerde</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <h1>Snelle acties</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<div class="align">
<h1>Registratie gedetineerde</h1>

<form action="/project08/pages/GedetineerdePaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="naam" placeholder="Naam"><br>
  <input type="text" name="achternaam" placeholder="Achternaam"><br>
  <input type="text" name="huisadres" placeholder="Huisadres"><br>
  <input type="text" name="woonplaats" placeholder="Woonplaats"><br>
  <input type="text" name="zaaknummer" placeholder="Zaaknummer"><br>
  <input type="text" name="bsnnummer" placeholder="BSN-nummer"><br>
  <input type="text" name="celnummer" placeholder="Celnummer"><br>
  <input type="text" name="datum" placeholder="Datum van arrestatie" onfocus="(this.type='date')"><br>
  <input type="text" name="datumuitbewaring" placeholder="Datum uit bewaring" onfocus="(this.type='date')"><br>
  <input type="text" name="redenhechtenis" placeholder="Reden van hechtenis"><br>
  <input type="text" name="aantekeningen" placeholder="Aantekeningen gedrag"><br>
  <input type="text" name="verslag" placeholder="Verslag"><br>
  <input type="text" name="bewijs" placeholder="Bewijs"><br>
  <input type="text" name="getuigen" placeholder="Getuigen"><br><br>
  <input type="file" name="image"><br>
  <input type="file" name="files[]" multiple><br><br><br>
  <input type="submit" value="submit" name="submit1">
  <p><?php if(isset($_SESSION["status"])) { echo $_SESSION["status"]; unset($_SESSION["status"]); } ?></p>
</form>
</div>
</div>

<div class="con2">
<h1>Celverplaatsing gedetineerde</h1>

<form action="/project08/pages/GedetineerdePaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="bsn" placeholder="BSN-nummer"><br>
  <input type="text" name="nieuwec" placeholder="Nieuwe cel"><br>
  <input type="date" name="datum"><br><br><br>
  <input type="submit" value="submit" name="submit2">
  <p><?php if(isset($_SESSION["status2"])) { echo $_SESSION["status2"]; unset($_SESSION["status2"]); } ?></p>
</form>
</div>

<div class="con2">
<h1>(Ont)koppelen gedetineerde</h1>

<form action="/project08/pages/GedetineerdePaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="bsn" placeholder="BSN-nummer"><br>
  <input type="text" name="username" placeholder="Gebruikersnaam medewerker"><br><br><br>
  <input type="submit" value="submit" name="submit3">
  <p><?php if(isset($_SESSION["status3"])) { echo $_SESSION["status3"]; unset($_SESSION["status3"]); } ?></p>
</form>
</div>

<div class="con2">
<h1>Vewijderen gedetineerde</h1>

<form action="/project08/pages/GedetineerdePaneel.php" method="post" enctype="multipart/form-data">
  <input type="text" name="bsn" placeholder="BSN-nummer"><br><br><br>
  <input type="submit" value="submit" name="submit4">
  <p><?php if(isset($_SESSION["status4"])) { echo $_SESSION["status4"]; unset($_SESSION["status4"]); } ?></p>
</form>
</div>




      
</body>
</html>

<?php
///gedtineerde
if (isset($_POST['submit1'])){
    $naam=isset($_POST['naam']) ? addslashes($_POST['naam']) : "";
    $achternaam=isset($_POST['achternaam']) ? addslashes($_POST['achternaam']) : "";
    $huisadres=isset($_POST['huisadres']) ? addslashes($_POST['huisadres']) : "";
    $woonplaats=isset($_POST['woonplaats']) ? addslashes($_POST['woonplaats']) : "";
    $zaaknummer=isset($_POST['zaaknummer']) ? addslashes($_POST['zaaknummer']) : "";
    $bsnnummer=isset($_POST['bsnnummer']) ? addslashes($_POST['bsnnummer']) : "";
    $celnummer=isset($_POST['celnummer']) ? addslashes($_POST['celnummer']) : "";
    $datum=isset($_POST['datum']) ? addslashes($_POST['datum']) : "";
    $datumb=isset($_POST['datumuitbewaring']) ? addslashes($_POST['datumuitbewaring']) : "";
    $redenh=isset($_POST['redenhechtenis']) ? addslashes($_POST['redenhechtenis']) : "";
    $aant=isset($_POST['aantekeningen']) ? addslashes($_POST['aantekeningen']) : "";
    $verslag=isset($_POST['verslag']) ? addslashes($_POST['verslag']) : "";
    $bewijs=isset($_POST['bewijs']) ? addslashes($_POST['bewijs']) : "";
    $getuigen=isset($_POST['getuigen']) ? addslashes($_POST['getuigen']) : "";
    $g = $fun->InsertIntoGedetineerdePG($naam, $achternaam, $huisadres, $woonplaats, $zaaknummer, $bsnnummer, $celnummer, $datum, $datumb, $redenh, $aant, $verslag, ' ', $bewijs, $getuigen);
    $status = $statusMsg = ''; 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = file_get_contents($image, FILE_BINARY); 
            $ginsert = $fun->InsertIntoImageGedetineede($imgContent, 'pasfoto', $bsnnummer);
             
            if($ginsert == 1){ 
              $_SESSION["status"] = "Succesvol";
              header("Refresh:0; url=GedetineerdePaneel.php");
            }else{ 
              $_SESSION["status"] = "Mislukt om te uploaden";
              header("Refresh:0; url=GedetineerdePaneel.php"); 
            }  
        }else{ 
          $_SESSION["status"] = "Bestandstype niet toegestaan";
          header("Refresh:0; url=GedetineerdePaneel.php");
        } 
    }else{ 
      $_SESSION["status"] = "Selecteer een afbeelding om te uploaden";
      header("Refresh:0; url=GedetineerdePaneel.php");
    } 

    $count = 0;
    foreach($_FILES['files']['name'] as $file) {
      $count++;
    }
    for($i=0;$i<$count;$i++){
      if(!empty($_FILES["files"]["name"][$i])) { 
        $fileName2 = basename($_FILES["files"]["name"][$i]); 
        $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION); 
         
        $allowTypes2 = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType2, $allowTypes2)){ 
            $image2 = $_FILES['files']['tmp_name'][$i]; 
            $imgContent2 = file_get_contents($image2, FILE_BINARY); 
            $ginsert2 = $fun->InsertIntoBewijsMateriaal($imgContent2, $bsnnummer);
            print_r($imgContent2);
        }
    }
}
}
////
if (isset($_POST['submit2'])){
    $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
    $nieuwec=isset($_POST['nieuwec']) ? addslashes($_POST['nieuwec']) : "";
    $datum=isset($_POST['datum']) ? addslashes($_POST['datum']) : "";
}
if (isset($_POST['submit2'])){
$array = $fun->SelectFromGedetineerdePG($bsn);
$oudec = $array['Celnummer'];

$check = $fun->CheckIfExistGedetineerde($bsn);
if($check == 1) {
    $check2 = $fun->InsertIntoGedetineerdeCel($bsn, $oudec, $nieuwec, $datum);
    if($check2 == 1) {
        $check3 = $fun->UpdateCelGedetineerdePG($nieuwec, $bsn);
        if($check == 1) {
            $_SESSION["status2"] = "Succesvol";
            header("Refresh:0; url=GedetineerdePaneel.php");
        }
        else{
            $_SESSION["status2"] = "Er is een fout opgetreden met het updaten van de celnummer bij de persoonsgegevens van de gedetineerde";
             header("Refresh:0; url=GedetineerdePaneel.php");
        }
    }
    else{
        $_SESSION["status2"] = "Er is een onbekende fout opgetreden, probeer opnieuw";
        header("Refresh:0; url=GedetineerdePaneel.php");
    }
}
else{
  $_SESSION["status2"] = "Geen gedetineerde met deze BSN nummer, BSN is fout of gedetineerde is niet geregistreerd";
  header("Refresh:0; url=GedetineerdePaneel.php");
}
}
///
if (isset($_POST['submit3'])){
    $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
    $Gebruikersnaam=isset($_POST['username']) ? addslashes($_POST['username']) : "";
}
if (isset($_POST['submit3'])){
$check = $fun->CheckIfExistGedetineerde($bsn);
if($check == 1) {
    $check2 = $fun->SelectFromGebruiker($Gebruikersnaam);
    if($check2 == 1) {
        $check3 = $fun->SelectFromKoppelen($bsn, $Gebruikersnaam);
        if($check3 == 0) {
            $check4 = $fun->InsertIntoKoppelen($bsn, $Gebruikersnaam);
            if($check4 == 1) {
                $_SESSION["status3"] = "Succesvol gekoppeld";
                header("Refresh:0; url=GedetineerdePaneel.php");
            }
            else{
                $_SESSION["status3"] = "Er ging iets fout tijdens het koppelen, probeer opnieuw";
                header("Refresh:0; url=GedetineerdePaneel.php");
            }
        }
        else{
            $check5 = $fun->DeleteFromKoppelen($bsn, $Gebruikersnaam);
            if($check5 == 1) {
                $_SESSION["status3"] = "Succesvol geontkoppeld";
                header("Refresh:0; url=GedetineerdePaneel.php");
            }
            else{
                $_SESSION["status3"] = "Er ging iets fout tijdens het ontkoppelen, probeer opnieuw";
                header("Refresh:0; url=GedetineerdePaneel.php");
            }
        }
    }
    else{
        $_SESSION["status3"] = "Gebruiker bestaat niet";
        header("Refresh:0; url=GedetineerdePaneel.php");
    }
}
else{
    $_SESSION["status3"] = "Gedetineerde bestaat niet";
    header("Refresh:0; url=GedetineerdePaneel.php");
}
}
/////
if (isset($_POST['submit4'])){
  $bsn=isset($_POST['bsn']) ? addslashes($_POST['bsn']) : "";
}
if (isset($_POST['submit4'])){
$check = $fun->DeleteFromGedetineerdePG($bsn);
if($check >= 1) {
  $_SESSION["status4"] = "Succesvol verwijderd";
  header("Refresh:0; url=GedetineerdePaneel.php");
}
else{
  $_SESSION["status4"] = "Niet gelukt om te verwijderen, Is het al verwijderd?";
  header("Refresh:0; url=GedetineerdePaneel.php");
}
}
////
?>