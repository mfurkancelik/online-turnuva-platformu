<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/haberler.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="style/hover.css" rel="stylesheet"/>
    <meta charset="utf-8">
    <title>FaceFight Beta V0.1</title>
  </head>
  <body>
     <div class="header">
         <div class ="leftlogo"><img src="images/logo.png"></div><div class ="detay1"> </div><div class ="detay2"> </div>
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

<div class="slideshow-container">
<div class ="onecikan"><p>ÖNE ÇIKANLAR</p></div>
 <div class="mySlides fade">
   <img src="images/img_nature_wide.jpg" style="width:100%">
   <div class="text">Caption Text</div>
 </div>

 <div class="mySlides fade">
   <img src="images/img_snow_wide.jpg" style="width:100%">
   <div class="text">Caption Two</div>
 </div>

 <div class="mySlides fade">
   <img src="images/img_mountains_wide.jpg" style="width:100%">
   <div class="text">Caption Three</div>
 </div>

 <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
 <a class="next" onclick="plusSlides(1)">&#10095;</a>

 </div>

 <div style="text-align:center">
   <span class="dot" onclick="currentSlide(1)"></span>
   <span class="dot" onclick="currentSlide(2)"></span>
   <span class="dot" onclick="currentSlide(3)"></span>
 </div>

 <div class ="container">


 </div>
  </body>
  <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
</html>
