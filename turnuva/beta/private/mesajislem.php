<?php
include_once ("config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$kul_id = $user["id"];
$kul_nick = $user["nick"];
$aliciisim = $_POST['alici'];
$title = $_POST['konu'];
$message = $_POST['mesaj'];
$aliciid = "SELECT id FROM user where nick = '$aliciisim'";
$query= mysqli_query($con,$aliciid);
$idcek = mysqli_fetch_array($query);
$aliciidcek = $idcek['id'];
$kayit = "INSERT INTO pm (id,id2,title,user1,user2,message,zamandamgasi,user1read,user2read) VALUES ('$kul_id','$aliciidcek','$title','$kul_nick','$aliciisim','$message',now(),'1','0')";
if ($aliciidcek == 0) {
header("Location:../yenimesaj.php?durum=gonderilmedi");
}
else {
	if (empty($title) || empty($message)) {
    header("Location:../yenimesaj.php?durum=bosalanvar");
	}
	else {
	$db->query($kayit);
	header("Location:../yenimesaj.php?durum=gonderildi");
	}


}
?>
