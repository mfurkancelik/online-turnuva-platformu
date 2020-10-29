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
include 'header.php';
$kul_id = $user["id"];
$bilgial ="SELECT name , nick , avatar , steam_profil FROM user WHERE id = '$kul_id'";
$bilgialbaglan = mysqli_query($con,$bilgial);
$yenicek = mysqli_fetch_array($bilgialbaglan);
?>
<?php
         if ($_GET["durum"] == 'infoupdate') { ?>
             <script>
              toastr.success('Profil bilgileriniz güncellendi.')
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
           <div class = "profilbox">
             <?php echo "<img src=images/users/".$yenicek['avatar']." >" ; ?>
             <form action="private/profil_guncelle.php" method="post" enctype='multipart/form-data' style="margin-top:5px;">
             <input type='file' name='file' />
             <input type="hidden" name="nickname" placeholder="Nickname" value = "<?php echo $yenicek["nick"] ?>">
             <input type='submit' value='Profil resmini değiştir' name='profilfotoyolla'>
             </form>
             </form>
            <form action="private/profil_guncelle.php" method="post" style="margin-top:5px;">
            <label>Ad-Soyad :</label><input type="text" name="isimsoyisim" placeholder="İsim-Soyisim" value = "<?php echo $yenicek["name"] ?>">
            <label>Steam Profil :</label><input type="text" name="steamprofil" placeholder="Steam Profil" value = "<?php echo $yenicek["steam_profil"] ?>">
            <label>Nickname :</label><input type="text" name="nickname" placeholder="Nickname" value = "<?php echo $yenicek["nick"] ?>">
            <button class="guncellebuton"type ="submit" name="ayarguncelle">Güncelle</button>
            </form>
           </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>

</html>
