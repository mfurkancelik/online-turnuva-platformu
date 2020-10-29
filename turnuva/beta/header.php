<?php include_once ("private/config.php");?>
<script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.2.1/dist/jquery.min.js"></script>
<script src="style/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="style/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style/toastr.css" rel="stylesheet"/>
<link href="style/hover.css" rel="stylesheet"/>
<title>Face2Fight Beta v0.1</title>
<?php
$kul_id = $user["id"];
$avataral ="SELECT * FROM user WHERE id = '$kul_id'";
$query= mysqli_query($con,$avataral);
$avatarallen = mysqli_fetch_array($query);
$sitedetay = mysqli_query($con,"SELECT * FROM sitedetay where id = 1");
$sitedetayal = mysqli_fetch_array($sitedetay);
?>
<div class ="header">
   <div id ="logo"><img src="images/logo.png"></div>
   <div class="navbar">
<ul>
    <li><a href="https://beta.face2fight.com" class="hvr-fade">TURNUVALAR</a></li>
    <li><a href="haberler" class="hvr-fade">HABERLER</a></li>
    <?php if(isset($_SESSION['login_user'])) { ?>
    <li><a href="profil" class="hvr-fade">KULLANICI PANELİ</a></li>
  <?php  } ?>
</ul>
</div>

    <?php if(!isset($_SESSION['login_user'])) { ?>
    <div class ="loginpanel">
    <form  method="post" action="private/login_check.php">
    <input class="girisadi" type="text" name="username" id="username" placeholder="Kullanıcı Adı">
    <input class="kulpass" type="password" name="password" id="password" placeholder="Şifre">
    <button class="girisbuton" name = "girisyap">Giriş Yap</button>
	<button class="kayitolbut" name ="kayitol">Kayıt Ol</button>
    </div>
    </form>

    <?php } else { ?>
    <div class ="uyepanel">
    <div class="nickname"><p><?php echo $user["nick"];?></p></div> <?php echo "<img src=images/users/".$avatarallen['avatar']." >" ; ?>
    <a href='cikis.php'>Çıkış</a>
    </div>

    <?php } ?>

</div>
<div class="subbar">

<div id ="oyunlogo"> <img src="images/<?php echo $sitedetayal['top_oyunlogo']; ?>">
</div>
<div class="anaturnuva">
<p> <?php echo $sitedetayal['top_oyun']; ?></p> <img src="images/check.png">
</div>

</div>
<?php
         if ($_GET["type"] == 'success') { ?>
             <script>
              toastr.success('Üyeliğiniz oluşturuldu artık giriş yapabilirsiniz.')
             </script>
      <?php    } ?>

      <?php  if ($_GET["type"] == 'error') { ?>
            <script>
              toastr.error('Kullanıcı adı ve ya şifre yanlış')
            </script>
      <?php  } ?>
      <?php  if ($_GET["type"] == 'nologin') { ?>
            <script>
              toastr.error('Bu alanı görmek için giriş yapmanız gerekiyor')
            </script>
      <?php  } ?>
