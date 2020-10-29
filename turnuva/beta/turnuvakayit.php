<?php
include_once ("private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["login_user"];
$turnuva_id = $_GET['id'];
$kul_id = $user["id"];
// TAKIM ID CEKME //
$idcek1 = mysqli_query($con, "SELECT oyuncular.*,takimlar.* FROM takimlar INNER JOIN oyuncular ON takimlar.id = oyuncular.takim_id where oyuncular.kul_id = '$kul_id'");
$idcek1cek = mysqli_fetch_array($idcek1);
$idcekanam1 = $idcek1cek['takim_id'];
// TAKIM ID CEKME //
// SLOT ÇEKMEK //
$result = mysqli_query($con,"SELECT * FROM turnuvalar where id ='$turnuva_id'");
$resultcek = mysqli_fetch_assoc($result);
// SLOT ÇEKMEK //
//KATILDIMI KONTROL//
$kontrol = ("SELECT * FROM turnuvakatilimci where takim_id = '$idcekanam1' AND  tur_id = '$turnuva_id'");
$kontrolyap = mysqli_query($con,$kontrol);
// KATILDIMI KONTROL //
if (mysqli_num_rows($kontrolyap) > 0)
{
  header("Location:turnuva.php?id=$turnuva_id&durum=kayitvar");
}
else {
$kayityap = "INSERT INTO turnuvakatilimci (takim_id,tur_id) VALUES ($idcekanam1,$turnuva_id)";
$slotguncelle ="UPDATE turnuvalar SET turnuva_kalanslot = (turnuva_kalanslot - 1) where id = '$turnuva_id' ";
$db->query($kayityap);
$db->query($slotguncelle);
header("Location:turnuva.php?id=$turnuva_id&durum=kayitalindi");
}

?>
