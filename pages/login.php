<!DOCTYPE html>
<html>
<title>Inloggen</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/project08/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="/Project08/index.php">
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
<div class="align">
<br><br><br>
<h1>Inloggen</h1>
<form action="/project08/pages/login.php" method="post">
  <input type="text" name="fname" placeholder="Gebruikersnaam"><br>
  <input type="text" name="lname" placeholder="Wachtwoord"><br><br>
  <input type="submit" value="submit" name="submit"><br><br>
  <a href="./passforgot.php" style="color: white;">Wachtwoord vergeten?</a>
</form>
<br><br><br><br><Br><BR>
</div>
</div>



      
</body>
</html>

<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project08/functions/functions.php");

$con = new dbh();
$fun = new Functions();

if (isset($_POST['submit'])){
    $user=isset($_POST['fname']) ? addslashes($_POST['fname']) : "";
    $pass=isset($_POST['lname']) ? addslashes($_POST['lname']) : "";
    $array = $fun->SelectUserHash($user);
    if (password_verify($pass, $array['Wachtwoord'])) {
      $fun->DeleteFromLoginLog($array['Gebruikersnaam']);
      $fun->InsertIntoLoginLog($array['Naam'], $array['Achternaam'], $array['Gebruikersnaam']);
        header("Refresh:0; url=HekkensluiterApplicatie.php");
        $_SESSION["hekkensluiter"] = true;
        $_SESSION["hekkensluiterNaam"] = $array['Naam'];  
        $_SESSION["hekkensluiterAchternaam"] = $array['Achternaam'];  
        $_SESSION["hekkensluiterFunctie"] = $array['Functie'];
        $_SESSION["hekkensluiterGebruikersnaam"] = $array['Gebruikersnaam'];
  } else {
  }
}

?>
