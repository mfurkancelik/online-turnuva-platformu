<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$result = mysqli_query($con,"SELECT * FROM turnuvalar ORDER BY turnuva_baslamatarih ASC");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
 <?php include 'header.php';?>
 <div class="container">
   <div class ="mainbox">
     <div class="ustbar">
       <li>OYUN</li>
       <li>TURNUVA</li>
       <li>TARİH</li>
       <li>SLOT</li>
       <li>ÖDÜL</li>
       <li>DETAYLAR</li>
     </div>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
<div class=turnuvabox>
<div class="turnuvafoto">
<?php echo "<img src='".$row['turnuva_foto']."' >" ;  ?>
</div>
<div class="turnuvaisim">
<h1> <?php echo $row['turnuva_isim']; ?> </h1>
</div>
<div class ="turnuvatarih">
<p><?php echo $row['turnuva_baslamatarih']; ?> </p>
</div>
<div class="turslot">
<p><?php echo $row['turnuva_slot']; ?> / <?php echo $row['turnuva_kalanslot']; ?>  </p>
</div>
<div class="turodul">
<p><?php echo $row['tur_odul']; ?> </p>
</div>
<div class ="turnuvadetay">
<a href="turnuva.php?id=<?php echo $row['id'];?>"><img src="images/go.png" ></a>
</div>
</div>
<?php  } ?>
   </div>
 </div>
  </body>
  <?php include 'footer.php';?>
</html>
