<?php
include_once ("../private/config.php");
$db = new Db();
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}
$user = $_SESSION["admin_user"];
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <link href="../style/admin.css" rel="stylesheet"/>
    <meta charset="utf-8">
  </head>
  <body>
      <div class = "loginwrap">
        <form  method="post" action="loginkontrol.php">
        <input class="girisadi" type="text" name="username" id="username" placeholder="Kullanıcı Adı">
        <input class="kulpass" type="password" name="password" id="password" placeholder="Şifre">
        <button class="girisbuton" name = "girisyap">Giriş Yap</button>
        </div>
  </body>
</html>
