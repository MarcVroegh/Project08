<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/Project07/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project07/functions/functions.php");

$con = new dbh();
$fun = new Functions();
?>
<!DOCTYPE html>
<html>
<title>Klantenportaal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./pages/login.php">
         <img alt="log in" src="/Project08/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px; ">
</a>
<a href="./pages/HekkensluiterApplicatie.php">
         <img alt="back" src="/Project08/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Klantenportaal</h1>
</div>

<div style="margin-top:100px">

<div class="con">
<h1>Welkom bij het Arrestantencomplex Hoornhek</h1>
<div class="con2">
<div class="NavBar">
  <div class="img_container">
    <img src="./images/police.png" class="icons" style="height: 250px">
  </div>
  <div class="img_container">
    <img src="./images/police2.png" class="icons" style="height: 250px">
  </div>
  <div class="img_container">
    <img src="./images/police3.png" class="icons" style="height: 250px">
  </div>
</div>
</div>
</div>

<div class="con2">
<div class="con2">
<h1><?php $check1 = $fun->SelectFromTextWebsite('1'); echo $check1["Titel1"]; ?></h1>
<p><?php $check1 = $fun->SelectFromTextWebsite('1'); echo $check1["Text1"]; ?></p>
</div>
</div>

<div class="con2">
<div class="con2">
<h1><?php $check1 = $fun->SelectFromTextWebsite('2'); echo $check1["Titel1"]; ?> </h1>
<p><?php $check1 = $fun->SelectFromTextWebsite('2'); echo $check1["Text1"]; ?></p>
</div>
</div>


      
</body>
</html>
