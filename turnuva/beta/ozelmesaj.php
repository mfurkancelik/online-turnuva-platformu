<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
if (!$user) {
    header("location: index.php?type=nologin");
    exit;
}
$kul_id = $user["id"];
$mesajcek = "SELECT mainid, title, LEFT(title, 5) ,zamandamgasi , user1, message FROM pm where id2 = '$kul_id' ORDER BY zamandamgasi DESC LIMIT 15 ";
$query2= mysqli_query($con,$mesajcek);
include 'header.php';
?>

<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <div class="container">
      <div class ="mainbox">
        <div class ="leftbar">
        <img class="kulpanellogo" src="images/kulpanel.png"> <label>KULLANICI PANELİ</label>
        <div class ="leftnavbar">
          <ul>
              <li><a href="profil.php">KİŞİSEL BİLGİLER</a></li>
              <li><a href="takim.php" style="padding-left:60px;padding-right:60px;" >TAKIM BİLGİLERİ</a></li>
              <li><a href="ozelmesaj.php" style="padding-left:78.2px;padding-right:78.2px;">ÖZEL MESAJ</a></li>
          </ul>
        </div>
        </div>
        <div class="newmessage">
        <a href="yenimesaj.php">Yeni Mesaj</a>
        </div>

        <div class = "profilpanel">
           <div class = "mesajbox">
             <div class="mesajtitle">
               <li>Gönderen</li>
               <li>Tarih</li>
               <li>Konu</li>
               <li>Mesaj</li>
             </div>
             <?php while($row = mysqli_fetch_assoc($query2)) { ?>
               <div class = "mesajwrap">
                 <div class="gonderen">
                  <p> <?php echo $row['user1'];?> </p>
                 </div>
                 <div class="tarih">
                 <p> <?php echo $row['zamandamgasi']; ?> </p>
                 </div>
                 <div class ="konu">
                 <p><?php echo substr($row['title'], 0, 10) ?></p>
                 </div>
                 <div class="mesaj">
                 <p><?php echo substr($row['message'], 0, 10) ?></p>
                 </div>
                 <div class ="mesajdetay">
                 <a href="mesajoku.php?id=<?php echo $row['mainid'];?>"><img src="images/go.png" ></a>
                 </div>
                 <?php  } ?>
               </div>
           </div>
        </div>
      </div>
    </div>
  </body>
  <?php include 'footer.php';?>
</html>
