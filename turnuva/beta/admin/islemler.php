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
$turnuvaisim = $_POST['turnuvaisim'];
$turnuvaseo = $_POST['turnuvaseo'];
$turnuvaoyunisim = $_POST['turnuvaoyunismi'];
$turnuvakisaisim = $_POST['turnuvakisaisim'];
$turnuvamod = $_POST['modlar'];
$turnuvaodul = $_POST['turnuvaodul'];
$turnuvakucukresim = $_POST['oyunkucukresim'];
$turnuvabuyukresim = $_POST['oyunbuyukresim'];
$turnuvabaslamatarih = $_POST['baslamatarih'];
$turnuvaonaytarih = $_POST['onaytarih'];
$turnuvageckayittarih = $_POST['geckayittarih'];
$turnuvaslot = $_POST['turnuvaslot'];
$turnuvakalanslot = $_POST['turnuvakalanslot'];
$turnuvaid = $_POST['turnuvaid'];
$takimid = $_POST['takimid'];
$userid = $_POST['userid'];
$takimidal = $_POST['takimidal'];
$oyundetayisim = $_POST['oyundetayisim'];
$oyundetaylogo = $_POST['oyundetaylogo'];
$haberisim = $_POST['haberisim'];
$haberdetay = $_POST['haberdetay'];
$haber_id = $_POST['haberid'];
$slayt_id = $_POST['slaytid'];
$slaytalttext = $_POST['slaytalttext'];
if (isset($_POST['turnuvaolustur'])) {
$kayit = "INSERT INTO turnuvalar (turnuva_isim,turnuva_seo,turnuva_oyunisim,turnuva_kisaisim,turnuva_mod,tur_odul,turnuva_foto,turnuva_bigfoto,turnuva_baslamatarih,turnuva_tarihonaylatma,turnuva_tarihgeckayit,turnuva_slot,turnuva_kalanslot)
VALUES
('$turnuvaisim','$turnuvaseo','$turnuvaoyunisim','$turnuvakisaisim','$turnuvamod','$turnuvaodul','$turnuvakucukresim','$turnuvabuyukresim','$turnuvabaslamatarih','$turnuvaonaytarih','$turnuvageckayittarih','$turnuvaslot','$turnuvakalanslot')";
$db->query($kayit);
header("Location:turnuvalar.php");
}
if (isset($_POST['turnuvasil'])) {
$delete ="DELETE FROM turnuvalar where id = '$turnuvaid'";
$db->query($delete);
header("Location:turnuvalar.php");
}
if (isset($_POST['turnuvaguncelle'])) {
$update ="UPDATE turnuvalar SET turnuva_isim='$turnuvaisim',turnuva_seo='$turnuvaseo',turnuva_oyunisim='$turnuvaoyunisim', turnuva_kisaisim='$turnuvakisaisim', turnuva_mod='$turnuvamod', turnuva_foto='$turnuvakucukresim',
turnuva_bigfoto='$turnuvabuyukresim',turnuva_baslamatarih='$turnuvabaslamatarih',turnuva_tarihonaylatma='$turnuvaonaytarih',turnuva_tarihgeckayit='$turnuvageckayittarih',turnuva_slot='$turnuvaslot',turnuva_kalanslot='$turnuvakalanslot' WHERE id = '$turnuvaid'";
$db->query($update);
header("Location:turnuvalar.php");
}
if (isset($_POST['usersil'])) {
$delete3 ="DELETE FROM user where id = '$userid'";
$delete4 ="DELETE FROM oyuncular where id = '$userid'";
$delete5 ="DELETE FROM takimlar where id = '$userid'";
$db->query($delete3);
$db->query($delete4);
$db->query($delete5);
header("Location:turnuvalar.php");
}
if (isset($_POST['takimsil'])) {
$delete ="DELETE FROM takimlar where id = '$takimid'";
$delete2 ="DELETE FROM oyuncular where takim_id ='$takimid'";
$db->query($delete);
$db->query($delete2);
header("Location:index.php");
}
if (isset($_POST['takimcikar'])) {
$delete ="DELETE FROM turnuvakatilimci where takim_id = '$takimidal'";
$db->query($delete);
header("Location:turnuvalar.php");
}
if (isset($_POST['detaydegistir'])) {
$update ="UPDATE sitedetay SET top_oyun='$oyundetayisim',top_oyunlogo='$oyundetaylogo'";
$db->query($update);
header("Location:index.php");
}
if (isset($_POST['habergir'])) {

  $name = $_FILES['file']['name'];
  $name2 = $_FILES['file2']['name'];
  $target_dir = "../images/haberler/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $target_file2 = $target_dir . basename($_FILES["file2"]["name2"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
  $kayityapulen = "INSERT INTO haberler (haber_isim,haber_thumbnail,haber_icbuyukfoto,haber_detay) VALUES ('$haberisim','$name','$name2','$haberdetay')";
  $db->query($kayityapulen);
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  move_uploaded_file($_FILES['file2']['tmp_name'],$target_dir.$name2);
  header("Location:habergir.php");
  }
  else {
      print_r($kayit);
  header("Location:habergir.php");
  }
}
if (isset($_POST['habersil'])) {
$delete ="DELETE FROM haberler where id = '$haber_id'";
$db->query($delete);
header("Location:habergir.php");
}
if (isset($_POST['slaytsil'])) {
$delete ="DELETE FROM haberler_slayt where id = '$slayt_id'";
$db->query($delete);
header("Location:index.php");
}

if (isset($_POST['slaytekle'])) {

  $name = $_FILES['file']['name'];
  $target_dir = "../images/haberler/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
  $kayityap = "INSERT INTO haberler_slayt (slayt_text,slayt_foto) VALUES ('$slaytalttext','$name')";
  $db->query($kayityap);
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  header("Location:index.php");
  }
  else {
  header("Location:index.php");
  }
}

?>
