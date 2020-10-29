<?php
include_once ("../private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$id = $_GET['id'];
$haberler = mysqli_query($con,"SELECT * FROM haberler where id = '$id'");
$haberlericek = mysqli_fetch_array($haberler);
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/haberler.css">
    <link href="../style/hover.css" rel="stylesheet"/>
    <meta charset="utf-8">
    <title>FaceFight Beta V0.1</title>
  </head>
  <body>
     <div class="header">
         <div class ="logoleftside"><img src="../images/logo.png"></div><div class="logorightside"></div><div class ="detay1"> </div><div class ="detay2"> </div>
         <div class ="navbar">
           <ul>
               <li><a href="index.php" class="hvr-fade">ANASAYFA</a></li>
               <li><a href="haberler.php" class="hvr-fade">İNCELEMELER</a></li>
               <li><a href="profil.php" class="hvr-fade">VİDEOLAR</a></li>
               <li><a href="profil.php" class="hvr-fade">TURNUVALAR</a></li>
           </ul>
         </div>
         <div class ="searchbar">
           <form action="haberler.html" method="post">
             <input type="text"  name="" value="" placeholder="Aradığınız kelimeyi yazınız.">
           </form>
         </div>
     </div>
     <div class="habercontainer">
        <div class ="haberbaslik">
        <h1><?php echo $haberlericek['haber_isim']; ?></h1>
        </div>
        <div class ="haberbuyukresim">
        <img src="../images/haberler/<?php echo $haberlericek['haber_icbuyukfoto']; ?>">
        </div>
        <div class ="haberdetaylar">
        <p><?php echo $haberlericek['haber_detay']; ?></p>
        </div>
        <div class="habergecis"><div class="oncekihaber"> </div> <div class="sonrakihaber"> </div> </div>
     </div>
