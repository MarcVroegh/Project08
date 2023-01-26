<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten3($_SESSION["hekkensluiterFunctie"]);
if ($result['infogedetineerde'] == 1) {
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

<form action="/project08/pages/informatie.php" method="post" enctype="multipart/form-data">
<div class="options">
  <select name="bsn" id="bsn" style="width: 60%; height: 40px; border-radius: 10px; background: #232222;"> 
      <?php
      $c = $fun->SelectGedetineerdePG();
      foreach($c as $value){
      ?>
      <option value="<?php echo strtolower($value['BSNnummer']); ?>"><?php echo $value['BSNnummer']; ?></option>
      <?php
      }
      ?>
    </select>
    </div>
    <br>
  <input type="submit" value="submit" name="submit">
  <p><?php if(isset($_SESSION["status20"])) { echo $_SESSION["status20"]; unset($_SESSION["status20"]); } ?></p>
</form>
</div>
</div>


      
</body>
</html>