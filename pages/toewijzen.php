<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten7($_SESSION["hekkensluiterFunctie"]);
if ($result['rechtentoewijzen'] == 1) {
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
<title>Actiepaneel aanpassen</title>
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
<h1>Rechten toewijzen</h1>

<form action="/project08/pages/toewijzen.php" method="post" enctype="multipart/form-data">
    <select name="waarde" id="waarde" style="width: 60%; height: 40px; border-radius: 10px; background: #232222;"> 
      <?php
      $c = $fun->DropDownRechten();
      foreach($c as $value){
      ?>
      <option value="<?php echo strtolower($value['Functie']); ?>"><?php echo $value['Functie']; ?></option>
      <?php
      }
      ?>
    </select>
  <br>
  <input type="checkbox" id="quickactionsgedetineerde" name="quickactionsgedetineerde" value="1">
  <label for="1">Snelle acties gedetineerde</label><br>
  <input type="checkbox" id="quickactionsbezoekers" name="quickactionsbezoekers" value="1">
  <label for="2">Snelle actie bezoekers</label><br>
  <input type="checkbox" id="informationgedetineerde" name="informationgedetineerde" value="1">
  <label for="3">Info gedetineerde</label><br><br>
  <input type="checkbox" id="settings" name="settings" value="1">
  <label for="4">Instellingen</label><br><br>
  <input type="checkbox" id="changebeheermodule" name="changebeheermodule" value="1">
  <label for="5">Aanpassen beheermodule</label><br><br>
  <input type="checkbox" id="makebeheermodule" name="makebeheermodule" value="1">
  <label for="6">Aanmaken beheermodule</label><br><br>
  <input type="checkbox" id="assignrights" name="assignrights" value="1">
  <label for="7">Rechten toewijzen</label><br><br>
  <input type="checkbox" id="Approvecelbezetting" name="Approvecelbezetting" value="1">
  <label for="8">Celbezetting</label><br><br>
  <input type="submit" value="submit" name="submit1">
  <p><?php if(isset($_SESSION["status50"])) { echo $_SESSION["status50"]; unset($_SESSION["status50"]); } ?></p>
</form>
</div>
</div>

</body>
</html>
<?php
if (isset($_POST['submit1'])){
    $waarde=isset($_POST['waarde']) ? addslashes($_POST['waarde']) : "";
    $quickactionsgedetineerde=isset($_POST['quickactionsgedetineerde']) ? addslashes($_POST['quickactionsgedetineerde']) : "";
    $quickactionsbezoekers=isset($_POST['quickactionsbezoekers']) ? addslashes($_POST['quickactionsbezoekers']) : "";
    $informationgedetineerde=isset($_POST['informationgedetineerde']) ? addslashes($_POST['informationgedetineerde']) : "";
    $settings=isset($_POST['settings']) ? addslashes($_POST['settings']) : "";
    $changebeheermodule=isset($_POST['changebeheermodule']) ? addslashes($_POST['changebeheermodule']) : "";
    $makebeheermodule=isset($_POST['makebeheermodule']) ? addslashes($_POST['makebeheermodule']) : "";
    $assignrights=isset($_POST['assignrights']) ? addslashes($_POST['assignrights']) : "";
    $approvecelbezetting=isset($_POST['Approvecelbezetting']) ? addslashes($_POST['Approvecelbezetting']) : "";

if ($quickactionsgedetineerde == 1){
    $een = 1;
}
else{
    $een = 0;
}

if ($quickactionsbezoekers == 1){
    $twee = 1;
}
else{
    $twee = 0;
}

if ($informationgedetineerde == 1){
    $drie = 1;
}
else{
    $drie = 0;
}

if ($settings == 1){
    $vier = 1;
}
else{
    $vier = 0;
}

if ($changebeheermodule == 1){
    $vijf = 1;
}
else{
    $vijf = 0;
}

if ($makebeheermodule == 1){
    $zes = 1;
}
else{
    $zes = 0;
}

if ($assignrights == 1){
    $zeven = 1;
}
else{
    $zeven = 0;
}

if ($approvecelbezetting == 1){
    $acht = 1;
}
else{
    $acht = 0;
}

$t = $fun->UpdateIntoRechten2($een, $twee, $drie, $vier, $vijf, $zes, $zeven, $acht, $waarde);
if ($t == 1){
    $_SESSION["status50"] = "Succesvol";
    header("Refresh:0; url=toewijzen.php");
}else{
    $_SESSION["status50"] = "Niet succesvol, probeer opnieuw";
    header("Refresh:0; url=toewijzen.php");
}
}