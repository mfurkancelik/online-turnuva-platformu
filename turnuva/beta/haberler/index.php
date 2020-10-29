<?php
include_once ("../private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$haberler = mysqli_query($con,"SELECT * FROM haberler ORDER BY id DESC LIMIT 6");
$haberlerslayt = mysqli_query($con,"SELECT * FROM haberler_slayt");
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
               <li><a href="https://beta.face2fight.com/haberler/" class="hvr-fade">ANASAYFA</a></li>
               <li><a href="https://beta.face2fight.com/haberler/" class="hvr-fade">İNCELEMELER</a></li>
               <li><a href="https://beta.face2fight.com/haberler/" class="hvr-fade">VİDEOLAR</a></li>
               <li><a href="https://beta.face2fight.com/" class="hvr-fade">TURNUVALAR</a></li>
           </ul>
         </div>
         <div class ="searchbar">
           <form action="haberler" method="post">
             <input type="text"  name="" value="" placeholder="Aradığınız kelimeyi yazınız.">
           </form>
         </div>
     </div>

<div class="slideshow-container">
<div class ="onecikan"><p>ÖNE ÇIKANLAR</p></div>
<?php while($habercek = mysqli_fetch_assoc($haberlerslayt)) { ?>
  <div class="mySlides fade">
    <a href="haberoku.php?id=<?php echo $habercek['haber_id']; ?>"><img src="../images/haberler/<?php echo $habercek['slayt_foto']; ?>" style="width:100%;cursor:pointer;"></a>
    <div class="text"><?php echo $habercek['slayt_text']; ?></div>
  </div>
<?php } ?>

 <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
 <a class="next" onclick="plusSlides(1)">&#10095;</a>

 </div>

 <div class ="container">
   <?php while($habercek2 = mysqli_fetch_assoc($haberler)) { ?>
     <div class ="haberbox">
       <div class ="haberisim">
       <h1><?php echo $habercek2['haber_isim']; ?></h1>
       </div>
       <div class="haberlogo">
       <img src="../images/haberler/<?php echo $habercek2['haber_thumbnail']; ?>">
       </div>
       <div class="haberlink">
       <a href="haberoku.php?id=<?php echo $habercek2['id']; ?>">Devamını Oku</a>
       </div>
     </div>
   <?php } ?>
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
