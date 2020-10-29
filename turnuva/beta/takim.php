<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect())
{
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
if (!$user)
{
    header("location: index.php?type=nologin");
    exit;
}
include 'header.php';
$kul_id = $user["id"];
$deneme1 = "SELECT oyuncular.*,takimlar.* FROM takimlar INNER JOIN oyuncular ON takimlar.id = oyuncular.takim_id WHERE oyuncular.kul_id = '$kul_id'";
$deneme1baglan = mysqli_query($con, $deneme1);
$deneme1cek = mysqli_fetch_array($deneme1baglan);
$takimbetakuladi = $deneme1cek['id'];
$takimbetakuladi2 = $deneme1cek['takim_id'];
/* TAKIM  - OYUNCU ÇEKME İŞLEMİ */
$deneme11 = "SELECT oyuncular.*,takimlar.* FROM takimlar INNER JOIN oyuncular ON takimlar.id = oyuncular.takim_id";
$deneme11baglan = mysqli_query($con, $deneme11);
$deneme11cek = mysqli_fetch_array($deneme11baglan);
$takimbetakuladi11 = $deneme1cek['takim_id'];
$deneme2 = mysqli_query($con,"SELECT * FROM oyuncular where takim_id = '$takimbetakuladi11'");
?>
<?php
if ($_GET["durum"] == 'created')
{ ?>

<script>
              toastr.success('Takım Oluşturuldu')
             </script>
      <?php
} ?>
      <?php
if ($_GET["durum"] == 'updated')
{ ?>
                   <script>
                    toastr.success('Takım Bilgileri Güncellendi.')
                   </script>
            <?php
} ?>
            <?php
if ($_GET["durum"] == 'deleted')
{ ?>
                         <script>
                          toastr.info('Takım Silindi.')
                         </script>
                  <?php
} ?>
                  <?php
if ($_GET["durum"] == 'takimadibos')
{ ?>
                               <script>
                                toastr.error('Takım adı girilmedi.')
                               </script>
                        <?php
} ?>
                        <?php
if ($_GET["durum"] == 'logoguncellendi')
{ ?>
                                     <script>
                                      toastr.success('Takım logosu güncellendi.')
                                     </script>
                              <?php
} ?>
                              <?php
if ($_GET["durum"] == 'yanlisdosyatipi')
{ ?>
                                           <script>
                                            toastr.error('Uygun olmayan dosya tipi.')
                                           </script>
                                    <?php
} ?>
                                    <?php
if ($_GET["durum"] == 'gsifre!')
{ ?>
                                                 <script>
                                                  toastr.error('Takım Giriş Şifresi Yanlış')
                                                 </script>
                                          <?php
} ?>
<?php
if ($_GET["durum"] == 'takimyok')
{ ?>
             <script>
              toastr.error('Böyle bir takım yok')
             </script>
      <?php
} ?>
<?php
if ($_GET["durum"] == 'cikildi')
{ ?>
             <script>
              toastr.info('Takımdan çıkıldı.')
             </script>
      <?php
} ?>
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
          <?php if (($takimbetakuladi == $takimbetakuladi2) && (!empty($takimbetakuladi)) && (!empty($takimbetakuladi2)))
{ ?>
            <div class="tab2">
            <button class="tablinks" onclick="openmenu(event, 'takimbox')">Oyuncu Detayları</button>
            <button class="tablinks" onclick="openmenu(event, 'takimlogo')">Takım Logosu</button>
            </div>
            <div id = "takimbox" class="tabcontent">
               <form action="private/takim_islem.php" method="post" style="margin-top:15px;">
               <label>Takım Adı :</label><input type="text" name="takimadi" placeholder="Takım ADI" value = "<?php echo ($deneme1cek["takim_adi"]) ?>">
               <div class ="takimlartitle" style="border-radius:0px;"><h1>OYUNCU LİSTESİ</h1> </div>
               <div class ="oyunculist">
                 <?php while($row3 = mysqli_fetch_assoc($deneme2)) { ?>
               <p> <?php echo $row3['oyuncu_nick'] ?> </p>
                 <?php } ?>
               </div>
               <?php if ($deneme1cek['yetki'] == '1')
    { ?>
               <button class="guncellebuton"type ="submit" name="takimguncelle">Bilgileri Güncelle</button>
               <button class="guncellebuton"type ="submit" name="takimsil">Takımı Sil</button>
             <?php
    }
    else
    { ?>
               <button class="guncellebuton"type ="submit" name="takimcik">Takımdan Çık</button>
          <?php
    } ?>

             </form>
            </div>
            <div id = "takimlogo" class="tabcontent">
            <?php echo "<img src=images/teams/" . $deneme1cek['takim_foto'] . " >"; ?>
            <?php if ($deneme1cek['yetki'] == '1')
 { ?>
   <form action="private/takim_islem.php" method="post" enctype='multipart/form-data'>
  <input type="hidden" name="takimadi" placeholder="Takım ADI" value = "<?php echo ($deneme1cek["takim_adi"]) ?>">
   <input type='file' name='file' />
   <input type='submit' style="margin-bottom:0px;" value='Takım Resmini Yükle' name='fotoyolla'>
   </form>
          <?php
 }
 else {?>
 <?php } ?>

            </div>
        <?php
}
else
{ ?>
            <div class ="takimlartitle" style="Float:left; margin-top:20px; margin-left:56px; width:580px;"><h1>BİR TAKIM OLUŞTUR</h1> </div>
            <div class ="takimprebox">
              <form action="private/takim_islem.php" method="post" style="margin-top:10px;">
              <label>Takım Adı :</label><input type="text" name="takimadi" placeholder="Takım ADI" value = "<?php echo $yenicek["takim_adi"] ?>">
              <label>Takım giriş şifresi :</label><input type="text" name="takimgirissifre" placeholder="Takım Giriş Şifresi" value = "<?php echo $deneme1cek["takim_sifre"] ?>">
              <button class="guncellebuton"type ="submit" name="takimolustur">Oluştur</button>
              </form>
            </div>
            <div class ="takimlartitle" style="Float:left; margin-top:10px; margin-left:56px; width:580px;"><h1>BİR TAKIMA KATIL</h1> </div>
            <div class ="takimprebox">
              <form action="private/takim_islem.php" method="post" style="margin-top:10px;">
              <label>Takım Adı :</label><input type="text" name="takimadi" placeholder="Takım ADI" value = "<?php echo $yenicek["takim_adi"] ?>">
              <label>Takım giriş şifresi :</label><input type="text" name="takimgirissifre" placeholder="Takım Giriş Şifresi" value = "<?php echo $deneme1cek["takim_sifre"] ?>">
              <button class="guncellebuton"type ="submit" name="takimkatil">Katıl</button>
              </form>
            </div>
        <?php
} ?>

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
   <?php include 'footer.php'; ?>
  </body>
</html>
