<?php
include_once ("../private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["admin_user"];
if (!$user) {
    header("location: login.php?type=nologin");
    exit;
  }
  $haber_id = $_GET['id'];
  $haberduzquer = mysqli_query($con,"SELECT * FROM haberler where id = '$haber_id'");
  $haberquerycek = mysqli_fetch_array($haberduzquer);
  $userler = mysqli_query($con,"SELECT * FROM user");
  $takimlar = mysqli_query($con,"SELECT * FROM takimlar");
  $turnuvakatilimci = mysqli_query($con,"SELECT * FROM turnuvakatilimci");
  $sitedetaylari = mysqli_query($con,"SELECT * FROM sitedetay");
  $haberlericek = mysqli_query($con,"SELECT * FROM haberler");
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <script src="https://cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script>
    <link href="../style/admin.css" rel="stylesheet"/>
    <meta charset="utf-8">
  </head>
  <body>
    <div class = "leftnav"><ul>
        <li><a href="index.php" class="hvr-fade">Anasayfa</a></li>
        <li><a href="turnuvalar.php" class="hvr-fade">Turnuva Ayarları</a></li>
        <li><a href="kullanicilar.php" class="hvr-fade">Kullanıcılar</a></li>
        <li><a href="habergir.php?id=1" class="hvr-fade">haber ayarları</a></li>
    </ul> </div>
    <div class="solagec" style="float:left">
      <h1 style="margin:auto; width:600px;">HABER GİRME BÖLÜMÜ</h1>
      <form class="" action="islemler.php" method="post" enctype='multipart/form-data'>
        <div class ="haberisim"style="margin:auto;width:600px;">
        <h1 style="margin:auto; width:600px;">HABER İSMİ</h1>
        <input type="text" name="haberisim" value="<?php echo $haberquerycek['haber_isim']; ?>" placeholder="" style="width:100%">
        <h1 style="margin:auto; width:600px;">HABER THUMBNAİL FOTO 300x150</h1>
        <input type='file' name='file'/>
        <h1 style="margin:auto; width:600px;">HABER iç büyük resim 800x350</h1>
        <input type='file' name='file2' />
        </div>
        <div class = "haberduzenleme">
          <textarea name="haberdetay" value =""><?php echo $haberquerycek['haber_detay']; ?></textarea>
          <script>
            CKEDITOR.replace( 'haberdetay' );
          </script>
        </div>
        <div class ="haberisim"style="margin:auto;width:600px;">
        <input type="submit" name="habergir" style="margin:auto;">
      </div>
      </form>
    </div>
    <div class="sagagec" style="float:right;">
      <?php while($haberrowcek = mysqli_fetch_assoc($haberlericek)) { ?>
        <form class="" action="islemler.php" method="post">
          <div class ="takimlist" style="margin-right:25px;width:185px;border:1px solid black; Float:left;">
          <label style="width:125px;">HABER AD:</label>
          <p style="margin-top:0px;width:150px;"><?php echo $haberrowcek['haber_isim']; ?> </p>
          <input type="hidden" name="haberid" value="<?php echo $haberrowcek['id']; ?>">
          <button onclick="location.href='habergir.php?id=<?php echo $haberrowcek['id'];?>'" type="button">haber BİLGİLERİNİ GETİR</button>
          <button class="guncellebuton"type ="submit" name="habersil">SİL</button>
          </div>
        </form>

      <?php } ?>
    </div>
