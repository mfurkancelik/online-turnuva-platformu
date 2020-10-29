<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
if (!$user) {
    header("location: index?type=nologin");
    exit;
}
include 'header.php';
?>
           <?php
               if ($_GET["durum"] == 'gonderilmedi') { ?>
                   <script>
                    toastr.error('Mesaj Gönderilmedi.')
                   </script>
            <?php    } ?>

            <?php
                     if ($_GET["durum"] == 'gonderildi') { ?>
                         <script>
                          toastr.success('Mesajınız Gönderildi.')
                         </script>
                  <?php    } ?>
				              <?php
                     if ($_GET["durum"] == 'bosalanvar') { ?>
                         <script>
                          toastr.error('Tüm alanlar doldurulmalıdır.')
                         </script>
                  <?php    } ?>
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
              <li><a href="profil">KİŞİSEL BİLGİLER</a></li>
              <li><a href="takim" style="padding-left:60px;padding-right:60px;" >TAKIM BİLGİLERİ</a></li>
              <li><a href="ozelmesaj" style="padding-left:78.2px;padding-right:78.2px;">ÖZEL MESAJ</a></li>
          </ul>
        </div>
        </div>
        <div class = "profilpanel">
          <div class = "yenimesajbox">
            <div class ="takimlartitle"><h1>Özel Mesaj</h1> </div>
            <form action="private/mesajislem.php" method="post" style="margin-top:10px;">
            <input type="text" name="alici" placeholder="Alıcı Nickname">
            <input type="text" name="konu" placeholder="Konu">
            <textarea name="mesaj" value = ""></textarea>
            <button class="guncellebuton"type ="submit" name="mesajgonder">Gönder</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
