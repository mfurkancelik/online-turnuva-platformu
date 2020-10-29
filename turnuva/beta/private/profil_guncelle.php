<?php
include_once ("config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
if (!$user) {
    header("location: login.php");
    exit;
}
$kul_id = $user["id"];
$nickname = $_POST['nickname'];
if (isset($_POST['ayarguncelle'])) {
$ayarkaydet ="UPDATE user SET name='".$_POST['isimsoyisim']."', nick='".$_POST['nickname']."',steam_profil='".$_POST['steamprofil']."' WHERE id = '$kul_id'";
$db->query($ayarkaydet);
header("Location:../profil.php?durum=infoupdate");
}

if(isset($_POST['profilfotoyolla'])){

$name = $_FILES['file']['name'];
$target_dir = "../images/users/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

// Select file type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("jpg","jpeg","png","gif");

// Check extension
if( in_array($imageFileType,$extensions_arr) ){
$newname = $nickname.'avatar'.'.png';
// Insert record
$query = "UPDATE user SET avatar ='".$newname."' where id ='$kul_id'";
$db->query($query);
// Upload file
move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$newname);
header("Location:../profil.php?durum=avatarguncellendi");
}
else {
header("Location:../profil.php?durum=yanlisdosyatipi");
}

}
?>
