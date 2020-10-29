<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$turnuva_id = $_GET['id'];
$result = mysqli_query($con,"SELECT * FROM turnuvalar where id ='$turnuva_id'");
$resultcek = mysqli_fetch_assoc($result);
$turnuvaslotkontrol = $resultcek['turnuva_kalanslot'];
$kul_id = $user["id"];
/* TAKIM  - OYUNCU ÇEKME İŞLEMİ */
$idcek1 = mysqli_query($con, "SELECT oyuncular.*,takimlar.* FROM takimlar INNER JOIN oyuncular ON takimlar.id = oyuncular.takim_id where takimlar.kul_id = '$kul_id'");
$idcek1cek = mysqli_fetch_array($idcek1);
$idcekanam1 = $idcek1cek['takim_id'];
$deneme2 = mysqli_query($con,"SELECT * FROM oyuncular where takim_id = '$idcekanam1'");
//KAYIT KONTROL //
$kontrol = ("SELECT * FROM turnuvakatilimci where takim_id = '$idcekanam1' AND  tur_id = '$turnuva_id'");
$kontrolyap = mysqli_query($con,$kontrol);
//KAYIT KONTROL //
$kontrol2 = ("SELECT * FROM takimlar where kul_id = '$kul_id'");
$kontrol2baglan = mysqli_query($con,$kontrol2);
$kontrolyap2 = mysqli_fetch_array($kontrol2baglan);
$takimkulid = $kontrolyap2['kul_id'];
$deneme1 = "SELECT oyuncular.*,takimlar.* FROM takimlar INNER JOIN oyuncular ON takimlar.id = oyuncular.takim_id WHERE oyuncular.kul_id = '$kul_id'";
$deneme1baglan = mysqli_query($con, $deneme1);
$deneme1cek = mysqli_fetch_array($deneme1baglan);
$takimbetakuladi = $deneme1cek['id'];
$takimbetakuladi2 = $deneme1cek['takim_id'];
$yetkicek = $deneme1cek['yetki'];
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
 <?php include 'header.php';?>
 <div class="container">
<div class ="mainbox">
<div class ="turnuvaheader">
<div class ="turoyunlogo"><?php echo "<img src='".$resultcek['turnuva_bigfoto']."' >" ; ?> </div>
<div class = "turoyunisim"> <p> <?php echo $resultcek['turnuva_isim']; ?> </p> <p style="font-family:proximaregular;"> <?php echo $resultcek['turnuva_slot']; ?> SLOT </p></div>
<?php if(isset($_SESSION['login_user'])) { ?>
  <?php if (($turnuvaslotkontrol == 0) && (mysqli_num_rows($kontrolyap) <= 0)) { ?>
    <p class ="katilmasyon">Turnuva Takım Limiti Doldu.</p>
  <?php  }
  else { ?>
    <?php if (mysqli_num_rows($kontrolyap) > 0)  { ?>
        <p class ="katilmasyon">Turnuva Kaydınız Alındı </p>
        <?php if ($yetkicek == 1) { ?>
          <form method="POST" id="form" name="form" action="turnuvacikis.php?id=<?php echo $turnuva_id ?>">
          <button class="buttonkatil hvr-ripple-out" name ="cikisyap">Turnuvadan Ayrıl</button>
          </form>
      <?php   } ?>
    <?php } else { ?>
      <?php if ($yetkicek == 1) { ?>
           <?php if ($resultcek['turnuva_mod'] == '5V5') { ?>
             <?php if (mysqli_num_rows($deneme2) >= 5) { ?>
               <form method="POST" id="form" name="form" action="turnuvakayit.php?id=<?php echo $turnuva_id ?>">
               <button class="buttonkatil hvr-ripple-out" name ="turnuvakatil">Turnuvaya Katıl</button>
               </form>
            <?php } else {?>
               <p class ="katilmasyon">TAKIMINIZDA EN AZ 5 OYUNCU OLMALI SİZİN <?php echo mysqli_num_rows($deneme2); ?> OYUNCUNUZ VAR<p>
          <?php   } ?>
          <?php }
          elseif($resultcek['turnuva_mod'] == '4V4') {?>
            <?php if (mysqli_num_rows($deneme2) >= 4) { ?>
              <form method="POST" id="form" name="form" action="turnuvakayit.php?id=<?php echo $turnuva_id ?>">
              <button class="buttonkatil hvr-ripple-out" name ="turnuvakatil">Turnuvaya Katıl</button>
              </form>
           <?php } else {?>
              <p class ="katilmasyon">TAKIMINIZDA EN AZ 4 OYUNCU OLMALI SİZİN <?php echo mysqli_num_rows($deneme2); ?> OYUNCUNUZ VAR<p>
         <?php   } ?>
          <?php }
          elseif($resultcek['turnuva_mod'] == '3V3') {?>
            <?php if (mysqli_num_rows($deneme2) >= 3) { ?>
              <form method="POST" id="form" name="form" action="turnuvakayit.php?id=<?php echo $turnuva_id ?>">
              <button class="buttonkatil hvr-ripple-out" name ="turnuvakatil">Turnuvaya Katıl</button>
              </form>
           <?php } else {?>
              <p class ="katilmasyon">TAKIMINIZDA EN AZ 3 OYUNCU OLMALI SİZİN <?php echo mysqli_num_rows($deneme2); ?> OYUNCUNUZ VAR<p>
         <?php   } ?>
          <?php }
          elseif($resultcek['turnuva_mod'] == '2V2') {?>
            <?php if (mysqli_num_rows($deneme2) >= 2) { ?>
              <form method="POST" id="form" name="form" action="turnuvakayit.php?id=<?php echo $turnuva_id ?>">
              <button class="buttonkatil hvr-ripple-out" name ="turnuvakatil">Turnuvaya Katıl</button>
              </form>
           <?php } else {?>
              <p class ="katilmasyon">TAKIMINIZDA EN AZ 2 OYUNCU OLMALI SİZİN <?php echo mysqli_num_rows($deneme2); ?> OYUNCUNUZ VAR<p>
         <?php   } ?>
          <?php }
          elseif($resultcek['turnuva_mod'] == '1V1'){ ?>
            <?php if (mysqli_num_rows($deneme2) >= 1) { ?>
              <form method="POST" id="form" name="form" action="turnuvakayit.php?id=<?php echo $turnuva_id ?>">
              <button class="buttonkatil hvr-ripple-out" name ="turnuvakatil">Turnuvaya Katıl</button>
              </form>
           <?php } else {?>
              <p class ="katilmasyon">TAKIMINIZDA EN AZ 1 OYUNCU OLMALI SİZİN <?php echo mysqli_num_rows($deneme2); ?> OYUNCUNUZ VAR<p>
         <?php   } ?>
          <?php } ?>


    <?php   }
       else { ?>
         <?php if ($yetkicek == 2) { ?>
           <p class ="katilmasyon">TAKIM KAPTANI DEĞİLSİNİZ<p>
        <?php  }
         else{ ?>
           <p class ="katilmasyon">TAKIMINIZ YOK<p>
      <?php    } ?>


    <?php   } ?>
     <?php    } ?>
  <?php } ?>
  <?php } ?>

</div>
<div class="tab">
<button class="tablinks" onclick="openmenu(event, 'genel')">GENEL BILGILER</button>
<button class="tablinks" onclick="javascript:location.href='https://face2fight.com/destek'">KURALLAR</button>
<button class="tablinks" onclick="openmenu(event, 'oyuncular')">KATILIMCILAR</button>
<button class="tablinks" onclick="openmenu(event, 'chart')">CHART</button>
</div>
<div id="genel" class="tabcontent">
  <div class ="zamanwrap">
  <div class ="zamanbox">
  <img src="images/timestart.png">
  <h1>BAŞLANGIÇ ZAMANI</h1>
  <p><?php echo $resultcek['turnuva_baslamatarih']; ?></p>
  </div>
  <div class ="zamanbox">
  <img src="images/timeconfirm.png">
  <h1>KAYIT ONAYLATMA</h1>
  <p><?php echo $resultcek['turnuva_tarihonaylatma']; ?></p>
  </div>
  <div class ="zamanbox">
  <img src="images/timelate.png">
  <h1>GEÇ KAYIT</h1>
  <p><?php echo $resultcek['turnuva_tarihgeckayit']; ?></p>
   </div>
  </div>
  <div class = "aciklamawrap">
   <h1>OYUN:</h1> <p><?php echo $resultcek['turnuva_oyunisim']; ?></p>
  </div>
  <div class = "aciklamawrap">
   <h1>MOD:</h1> <p><?php echo $resultcek['turnuva_mod']; ?></p>
  </div>
  <div class = "aciklamawrap">
   <h1>ÖDÜL:</h1> <p><?php echo $resultcek['tur_odul']; ?></p>
  </div>
  <div class = "aciklamawrap" style="margin-top:50px;">
   <h1 style="width:100%;">GEREKSİNİMLER:</h1> <p style="margin-left:10px;">&bull; OYUNCULAR TURNUVA SAATİNDEN ÖNCE EN GEÇ YARIM SAAT İÇERİSİNDE HAZIR OLMALIDIR.</p>
  </div>
  <div class = "aciklamawrap" style="margin-top:50px;">
   <h1 style="width:100%;">ÖNEMLİ KURALLAR:</h1> <p style="margin-left:10px;">&bull; OYUNCULAR TURNUVA ESNASINDA DISCORD SUNUCUMUZDA BULUNMALIDIR, AKSİ TAKDİRDE DİSKALİFİYE OLACAKTIR.</p>
   <p style="margin-left:10px;">&bull; TURNUVA ESNASINDA RAKİPLERE VE HAKEMLERE YAPILACAK HER TÜRLÜ HAKARET DİSKALİFİYE SEBEBİDİR.</p>
  </div>
</div>

<div id="kurallar" class="tabcontent">

  <h3>KURALLAR HAKKINDA</h3>
  <p>kuralların detaylı listesine destek.face2fight.com üzerinden ulaşabilirsiniz</p>
</div>

<div id="oyuncular" class="tabcontent">
  <?php
       $sql = ("SELECT takim_id,takim_adi,takim_foto FROM takimlar INNER JOIN turnuvakatilimci ON takimlar.id = turnuvakatilimci.takim_id where turnuvakatilimci.tur_id = $turnuva_id ");
       $query = mysqli_query($con,$sql);
        ?>
        <?php while($takims = mysqli_fetch_assoc($query)) { ?>
        <div class ="takimlarwrap">
        <label><?php echo $takims['takim_adi']; ?> </label>
        <?php echo "<img src=images/teams/".$takims['takim_foto']." >" ; ?>
        <?php
        $nickcekbabos = ("SELECT oyuncu_nick FROM oyuncular where takim_id = '".$takims['takim_id']."' LIMIT 5");
        $cektimbabus = mysqli_query($con,$nickcekbabos);
         ?>
        <?php while($ulacekeyrum = mysqli_fetch_assoc($cektimbabus)) { ?>
        <p><?php echo $ulacekeyrum['oyuncu_nick']; ?></p>
        <?php } ?>
        </div>
<?php  } ?>



</div>
<div id="chart" class="tabcontent">
<div class ="turchar"><iframe src="https://challonge.com/tr/<?php echo $resultcek['turnuva_chart']; ?>/module" width="100%" height="600" frameborder="0" scrolling="auto" allowtransparency="true"></iframe> </div>
</div>
</div>
</div>

 <script>
function openmenu(evt, menuitemname) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(menuitemname).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
  </body>
</html>
