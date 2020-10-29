<?php
include_once ("config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$kul_id = $user["id"];
$kul_nick = $user["nick"];
// TAKIM TEXTLERİ ÇEK//
$takimadi =$_POST['takimadi'];
$takimgirissifre =$_POST['takimgirissifre'];
if (isset($_POST['takimolustur'])) {
  if (empty($takimadi)){
    header("Location:../takim.php?durum=takimadibos");
  }
  else {
    $kayit = "INSERT INTO takimlar (kul_id,takim_adi,takim_sifre,takim_foto) VALUES ('$kul_id','$takimadi','$takimgirissifre','defaultteamlogo.png')";
    $db->query($kayit);
    $takimdancek = "SELECT id FROM takimlar where kul_id ='$kul_id' and takim_adi = '$takimadi' ";
    $takimdancekbaglan = mysqli_query($con,$takimdancek);
    $cek =mysqli_fetch_array($takimdancekbaglan);
    $takimidcek = $cek['id'];
    $oyuncudancek1 = "INSERT INTO oyuncular (kul_id,takim_id,oyuncu_nick,yetki) VALUES ('$kul_id','$takimidcek','$kul_nick','1')";
    $db->query($oyuncudancek1);
    header("Location:../takim.php?durum=created");
  }
  }
  if (isset($_POST['takimguncelle'])) {
    $kayit2 = "UPDATE takimlar SET takim_adi='$takimadi' WHERE kul_id = '$kul_id'";
    $db->query($kayit2);
    header("Location:../takim.php?durum=updated");
    }
    if (isset($_POST['takimsil'])) {
      $query = "SELECT takim_id from oyuncular where kul_id = '$kul_id'";
      $takimdancekbaglan = mysqli_query($con,$query);
      $cek =mysqli_fetch_array($takimdancekbaglan);
      $takim_idcek = $cek['takim_id'];
      $sil = "DELETE FROM takimlar where kul_id = '$kul_id'";
      $sil2 = "DELETE FROM oyuncular where takim_id = '$takim_idcek'";
      $db->query($sil);
      $db->query($sil2);
      header("Location:../takim.php?durum=deleted");
      }
      // takım katılma işlemleri
    if (isset($_POST['takimkatil'])) {
      $takimdancek = "SELECT id,takim_adi,takim_sifre FROM takimlar where takim_adi = '$takimadi'";
      $takimdancekbaglan = mysqli_query($con,$takimdancek);
      $cek =mysqli_fetch_array($takimdancekbaglan);
      $takimidcek = $cek['id'];
      $takimsifrecek = $cek['takim_sifre'];
      $takimadicek = $cek['takim_adi'];
      if ($takimadi == $takimadicek) {
        if ($takimgirissifre == $takimsifrecek) {
          $oyuncudoldur = "INSERT INTO oyuncular (kul_id,takim_id,oyuncu_nick,yetki) VALUES ('$kul_id','$takimidcek','$kul_nick','2')";
          $db->query($oyuncudoldur);
          header("Location:../takim.php?durum=katildi");
        }
        else {
          header("Location:../takim.php?durum=gsifre!");
        }
      }
      else {
        header("Location:../takim.php?durum=takimyok");
      }

      }
        // takım çıkma işlemleri
        if (isset($_POST['takimcik'])) {
          $sil = "DELETE FROM oyuncular where kul_id = '$kul_id'";
          $db->query($sil);
          header("Location:../takim.php?durum=cikildi");
            }
      //takım  fotoğraf islemleri
      if(isset($_POST['fotoyolla'])){
   $takimadi =$_POST['takimadi'];
   $name = $_FILES['file']['name'];
   $target_dir = "../images/teams/";
   $target_file = $target_dir . basename($_FILES["file"]["name"]);

   // Select file type
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   // Valid file extensions
   $extensions_arr = array("jpg","jpeg","png","gif");

   // Check extension
   if( in_array($imageFileType,$extensions_arr) ){
   $newname = $takimadi.'takimlogo'.'.png';
    // Insert record
    $query = "UPDATE takimlar SET takim_foto ='".$newname."' where kul_id ='$kul_id'";
    $db->query($query);
    // Upload file

    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$newname);
    header("Location:../takim.php?durum=logoguncellendi");
   }
   else {
     header("Location:../takim.php?durum=yanlisdosyatipi");
   }

  }
