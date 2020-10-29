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
  $turnuva_id = $_GET['id'];
  $user = $_SESSION["login_user"];
  $result = mysqli_query($con,"SELECT * FROM turnuvalar");
  $duzenlemequert = mysqli_query($con,"SELECT * FROM turnuvalar where id ='$turnuva_id'");
  $duzenlemecek = mysqli_fetch_array($duzenlemequert);
  $datebaslama = date("Y-m-d\TH:i:s", strtotime($duzenlemecek['turnuva_baslamatarih']));
  $dateonay = date("Y-m-d\TH:i:s", strtotime($duzenlemecek['turnuva_tarihonaylatma']));
  $dategeckayit = date("Y-m-d\TH:i:s", strtotime($duzenlemecek['turnuva_tarihgeckayit']));
  // turnuvadan takım çek //
  $turnuvatakim = mysqli_query($con,"SELECT * FROM turnuvakatilimci INNER JOIN takimlar ON turnuvakatilimci.takim_id = takimlar.id INNER JOIN turnuvalar ON turnuvakatilimci.tur_id = turnuvalar.id");
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
    </ul> </div>
    <div class = "islemlerwrap" style="width:860px;">
     <h1> TURNUVA EKLEME </h1>
     <form action="islemler.php" method="post" style="margin-top:10px;">
     <label style="width:100%;">TURNUVA İSİM</label>
     <input type="text" name="turnuvaisim" value="<?php echo $duzenlemecek['turnuva_isim'];?>" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA SEO (ÖZEL KARAKTER TÜRKÇE DAHİL KULLANMA ÖRN :deneme-turnuva-12)</label>
     <input type="text" name="turnuvaseo" value="<?php echo $duzenlemecek['turnuva_seo'];?>" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA OYUNİSİM</label>
     <input type="text" name="turnuvaoyunismi" value="<?php echo $duzenlemecek['turnuva_kisaisim'];?>" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA CHART ISMI ('https://challonge.com/tr/*face2fightcsgo1*)* KISIM İÇİNDEKİ ALINACAK CHART SONRADAN AYARLANICAKSA !!!!!NULL YAZ!!! VE BIRAK</label>
     <input type="text" name="turnuvachart" value="<?php echo $duzenlemecek['turnuva_chart'];?>" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA KISAİSİM</label>
     <select name="turnuvakisaisim" value="<?php echo $duzenlemecek['turnuva_kisaisim'];?>" style="width:50%;" >
     <option value="pubg">pubg</option>
     <option value="rckt">rockt</option>
     <option value="csgo">csgo</option>
     <option value="rbnw">rnbw</option>
     <option value="lol">lol</option>
     </select>
     <label style="width:100%;">TURNUVA MOD <?php echo $duzenlemecek['turnuva_mod'];?></label>
     <select name="modlar" value="<?php echo $duzenlemecek['turnuva_mod'];?>" style="width:50%;" ><?php echo $duzenlemecek['turnuva_mod'];?>
     <option value="1V1">1V1</option>
     <option value="2V2">2V2</option>
     <option value="3V3">3V3</option>
     <option value="4V4">4V4</option>
     <option value="5V5">5V5</option>
     </select>
     <label style="width:100%;">TURNUVA ödül (Örn: 700 TL)</label>
     <input type="text" value="<?php echo $duzenlemecek['tur_odul'];?>" name="turnuvaodul" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA OYUN LOGO (ANASAYFA)</label>
     <select name="oyunkucukresim" value="<?php echo $duzenlemecek['turnuva_foto'];?>" style="width:50%;">
     <option value="images/rocketsmall.png">rocketleague</option>
     <option value="images/csgosmall.png">cs:go</option>
     <option value="images/rainbowsmall.png">rainbow</option>
     <option value="images/lolsmall.png">lol</option>
     <option value="images/pubgsmall.png">pugb</option>
     </select>
     <label style="width:100%;">TURNUVA OYUN LOGO (İÇ SAYFA TURNUVA DETAY KISMI)</label>
     <select name="oyunbuyukresim" value="<?php echo $duzenlemecek['turnuva_bigfoto'];?>" style="width:50%;">
     <option value="images/rocket.png">rocketleague</option>
     <option value="images/csgo.png">cs:go</option>
     <option value="images/rainbow.png">rainbow</option>
     <option value="images/lol.png">lol</option>
     <option value="images/pubg.png">pugb</option>
     </select>
     <label style="width:100%;">TURNUVA Başlama Tarihi</label>
     <input type="datetime-local" value="<?php echo $datebaslama; ?>" name="baslamatarih" style="width:50%;">
     <label style="width:100%;">TURNUVA TARİH ONAYLATMA</label>
     <input type="datetime-local" value="<?php echo $dateonay; ?>" name="onaytarih" style="width:50%;">
     <label style="width:100%;">TURNUVA GEÇ KAYIT</label>
     <input type="datetime-local" value="<?php echo $dategeckayit; ?>" name="geckayittarih" style="width:50%;">
     <label style="width:100%;">TURNUVA SLOT</label>
     <input type="text" name="turnuvaslot" value="<?php echo $duzenlemecek['turnuva_slot'];?>" placeholder="" style="width:50%;">
     <label style="width:100%;">TURNUVA kalan slot</label>
     <input type="text" name="turnuvakalanslot" value="<?php echo $duzenlemecek['turnuva_kalanslot'];?>" placeholder="" style="width:50%;">
     <input type="hidden" name="turnuvaid" value="<?php echo $duzenlemecek['id']; ?>">
     <button style="width:50%;" class="guncellebuton"type ="submit" name="turnuvaolustur">Yeni Turnuva</button>
     <button style="width:50%;" class="guncellebuton"type ="submit" name="turnuvaguncelle">Düzenle</button>
   </form>
 </div>

<div class="openturnuvalar" style="margin-top:50px;margin-left:50px;width:560px;height:100%;">
   <h1 style="width:350px;"> TURNUVA SİLME VE DÜZENLEME </h1>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
  <form action="islemler.php" method="post" style="margin-top:10px;">
  <div class="turnuva"> <?php echo $row['turnuva_isim']; ?> </div>
  <input type="hidden" name="turnuvaid" value="<?php echo $row['id']; ?>">
  <button onclick="location.href='turnuvalar.php?id=<?php echo $row['id'];?>'" type="button">TURNUVA BİLGİLERİNİ GETİR</button>
  <button class="guncellebuton"type ="submit" name="turnuvasil">SİL</button>
  </form>
  <?php  } ?>
</div>
<div class ="openturnuvalar" style="Float:left;width:500px;">
<h1 style="width:350px;"> TURNUVADAN TAKIM ÇIKAR </h1>
<?php while($rowt = mysqli_fetch_assoc($turnuvatakim)) { ?>
  <div class ="katilantakimlar" style="border:1px solid black ;">
    <form action="islemler.php" method="post" style="margin-top:10px;">
    <label>TAKIM ADI :</label>
    <?php echo $rowt['takim_adi']; ?>
    <label>HANGİ TURNUVA :</label>
    <?php echo $rowt['turnuva_isim']; ?>
    <input type="hidden" name="takimidal" value="<?php echo $rowt['takim_id']; ?>">
    <button class="guncellebuton" type ="submit" name="takimcikar">ÇIKAR</button>
  </form>
  </div>
<?php } ?>
</div>
  </body>
</html>
