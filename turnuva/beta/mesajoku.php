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
$pm_id = $_GET['id'];
$kul_id = $user["id"];
$mesajcek = "SELECT mainid, title ,zamandamgasi , user1, message FROM pm where id2 = '$kul_id' AND mainid= '$pm_id'";
$query= mysqli_query($con,"SELECT mainid, title ,zamandamgasi , user1, message FROM pm where id2 = '$kul_id' AND mainid= '$pm_id'");
$resultcek = mysqli_fetch_assoc($query);
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
           <div class = "mesajokubox">
                   <label style="width:100%;"> Gönderen : </label>
                   <label style="height:30px;"> <?php echo $resultcek['user1']; ?>  </label>
                   <label style="width:100%;"> Konu :  </label>
                   <label style="height:30px;"> <?php echo $resultcek['title']; ?>  </label>
                   <label style="width:100%;"> Mesaj : </label>
                   <label style="height:250px;"> <?php echo $resultcek['message']; ?>  </label>
               </div>
           </div>
        </div>
      </div>
    </div>
  </body>
</html>
