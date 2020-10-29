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
    <div class = "islemlerwrap">
    <h1>KAYITLI KULLANICILAR</h1>
   <?php while($userrow = mysqli_fetch_assoc($userler)) { ?>
<div class ="takimlist" style="margin-right:25px;width:185px;border:1px solid black; Float:left;">
<label style="width:125px;">ADSOYAD:</label>
<p style="margin-top:0px;width:150px;"><?php echo $userrow['name']; ?> </p>
<label style="width:125px;">nick:</label>
<p style="margin-top:0px;width:150px;"><?php echo $userrow['nick']; ?> </p>
<label style="width:125px;">EMAIL:</label>
<p style="margin-top:0px;width:150px;"><?php echo $userrow['email']; ?> </p>
<input type="hidden" name="userid" value="<?php echo $userrow['id']; ?>">
<button class="guncellebuton"type ="submit" name="usersil">SİL</button>
</div>
   <?php } ?>
    </div>
  </body>
