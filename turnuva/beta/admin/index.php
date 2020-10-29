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
  $userler = mysqli_query($con,"SELECT * FROM user");
  $takimlar = mysqli_query($con,"SELECT * FROM takimlar");
  $turnuvakatilimci = mysqli_query($con,"SELECT * FROM turnuvakatilimci");
  $sitedetaylari = mysqli_query($con,"SELECT * FROM sitedetay");
  $haberslayt = mysqli_query($con,"SELECT * FROM haberler_slayt");
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <link href="../style/admin.css" rel="stylesheet"/>
    <meta charset="utf-8">
  </head>
  <body>
    <div class = "leftnav"><ul>
        <li><a href="index.php" class="hvr-fade">Anasayfa</a></li>
        <li><a href="turnuvalar.php" class="hvr-fade">Turnuva Ayarları</a></li>
        <li><a href="kullanicilar.php" class="hvr-fade">Kullanıcılar</a></li>
        <li><a href="habergir.php?id=1" class="hvr-fade">haber ayarları</a></li>
        <a href='cikis.php'>Çıkış</a>
    </ul> </div>
<div class = "islemlerwrap">
<h1>BİLGİLER</h1>
<p>KAYITLI TOPLAM <?php echo mysqli_num_rows($userler); ?> KULLANICI VAR </p>
<p>KAYITLI TOPLAM <?php echo mysqli_num_rows($takimlar); ?> TAKIM VAR </p>
<p>TURNUVALARA KAYITLI TOPLAM <?php echo mysqli_num_rows($turnuvakatilimci); ?> TAKIM VAR </p>
</div>
<div class="openturnuvalar" style="margin-top:50px;margin-left:50px;height:100%;">
 <?php while($takimrow = mysqli_fetch_assoc($takimlar)) { ?>
  <div class ="takimlist" style="margin-right:25px;width:75px;border:1px solid black; Float:left;">
  <label style="width:100%;">TAKIM ADI</label>
  <p><?php echo $takimrow['takim_adi']; ?> </p>
  <label style="width:100%;">TAKIM logo</label>
  <?php echo "<img src=../images/teams/" . $takimrow['takim_foto'] . " >"; ?>
  <form action="islemler.php" method="post" style="margin-top:10px;">
  <input type="hidden" name="takimid" value="<?php echo $takimrow['id']; ?>">
  <button class="guncellebuton"type ="submit" name="takimsil">SİL</button>
  </form>
  </div>
 <?php } ?>
</div>
<div class ="islemlerwrap">
<h1>ANASAYFA ÖNEMLİ TURNUVA KISMINI DEĞİŞTİR </h1>
<?php while($sitedetays = mysqli_fetch_assoc($sitedetaylari)) { ?>
  <form action="islemler.php" method="post" style="margin-top:10px;">
    <label style="width:50%;">ÖNEMLİ TURNUVA İSMİ</label>
    <input type="text" name="oyundetayisim" value="<?php echo $sitedetays['top_oyun'];?>" placeholder="" style="width:50%;">
    <label style="width:50%;">ÖNEMLİ TURNUVA OYUN LOGO ŞUANKİ LOGO : <?php echo $sitedetays['top_oyunlogo'];?></label>
    <select name="oyundetaylogo" value="" style="width:50%;margin-right:5px;" >
    <option value="csgosmall.png">csgo</option>
    <option value="pubgsmall.png">pubg</option>
    <option value="rainbowsmall.png">rainbow</option>
    <option value="lolsmall.png">lol</option>
    <option value="rocketsmall.png">rocket</option>
    </select>
    <button class="guncellebuton"type ="submit" name="detaydegistir">Değiştir</button>
  </form>
<?php } ?>
</div>

<div class ="islemlerwrap" style="width:1000px;">
<h1>HABERLER SLAYT DÜZENLEME</h1>
<?php while($slaytcek = mysqli_fetch_assoc($haberslayt)) { ?>
  <form class="" action="islemler.php" method="post">
    <div class ="slaytbox" style="border:1px solid black;width:200px;float:left;">
    <img style="width:200px;height:200px;float:left;" src="../images/haberler/<?php echo $slaytcek['slayt_foto']; ?>">
    <p style="float:left;"><?php echo $slaytcek['slayt_text']; ?></p>
    <input type="hidden" name="slaytid" value="<?php echo $slaytcek['id']; ?>">
    <button style="" class="guncellebuton"type ="submit" name="slaytsil">sil</button>
    </div>
  </form>
  <?php } ?>
  </div>

  <div class ="islemlerwrap" style="width:400px;border:1px solid black;">
  <h1 style="width:450px;float:left;">HABERLER SLAYT EKLEME</h1>
  <form class="" action="islemler.php" method="post" enctype='multipart/form-data'>
  <label>Slayt Alt Text </label>
  <input type="text" name="slaytalttext" value="" placeholder="" style="width:100%;float:left;">
  <input type='file' name='file'/>
  <button style="" class="guncellebuton"type ="submit" name="slaytekle">YOLLA</button>
  </form>
    </div>
  </body>
</html>
