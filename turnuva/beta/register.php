<?php
include_once("private/config.php");
$db = new Db();
/**
 * Veritabanımıza bağlanmaya çalışıyoruz.
 * Bağlanamazsak, hata mesajını ekrana yazdırıyoruz
 */
if (!$db->connect()) {
    die("Hata: Veritabanına bağlanırken bir hata oluştu." . $db->error());
}

/**
 * login_user oturum değişkeninden bilgileri alıyoruz ve
 * $user değişkenine kaydediyoruz.
 *
 * Eğer kullanıcımız oturum açmış ise, $user dolu olacak.
 * Eğer kullanıcımız daha önce oturum açmamış ise, $user boş olacak.
 *
 */
$user = $_SESSION["login_user"];

/**
 * Kullanıcı zaten üye olmuş ve
 * Oturum açmış ise, index.php ye yönlendiriyoruz.
 */
if ($user) {
    header("location: index.php");
    exit;
}


/**
 * Yapılan işlemi kontrol et.
 * Eğer işlem POST ise, kullanıcının forma girdiği bilgileri al.
 */
if ($_POST) {
    /**
     * Varsayılan olarak hata durumunu ve
     * Hata mesajını false/null olarak ayarla.
     * Hata bulursak bu değişkenleri dolduracağız.
     */
    $error = false;
    $errors = array();

    /**
     * Form dan gelen bilgileri al
     */
    $name = $_POST["name"];
    $nick = $_POST["nick"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    /**
     * Varsa değişkenlerde gereksiz boşluklar.
     * Bu boşlukları siliyoruz.
     */
    $name = trim($name);
    $nick = trim($nick);
    $email = trim($email);
    $password1 = trim($password1);
    $password2 = trim($password2);


    // ======== Basit Kontrolleri Gerçekleştir. ========
    /**
     * İsim girmiş mi ?
     */
    if (empty($name)) {
        /**
         * Hata yakaladık.
         * Vatandaş adını girmemiş.
         */
        $error = true;
        $errors[] = 'Lütfen adınızı girin. Bu alan boş bırakılamaz.';
    }

    /**
     * Soyisim girmiş mi ?
     */
    if (empty($nick)) {
        /**
         * Hata yakaladık.
         * Vatandaş Soyisim girmemiş.
         */
        $error = true;
        $errors[] = 'Lütfen Soyisim girin. Bu alan boş bırakılamaz.';
    }

    /**
     * Kullanıcı Adı/E-Posta Girmiş mi ?
     */
    if (empty($email)) {
        /**
         * Hata yakaladık.
         * Vatandaş kullanıcı adı girmemiş.
         */
        $error = true;
        $errors[] = 'Lütfen bir kullanıcı adı girin. Bu alan boş bırakılamaz.';
    }

    /**
     * Şifreler eşleşiyor mu kontrol et.
     */
    if ($password1 != $password2) {
        /**
         * Hata bulduk.
         * Şifreler eşleşmiyor.
         */
        $error = true;
        $errors[] = 'Şifreler Eşleşmiyor.';
    }

    /**
     * Şifre 4 karakterden uzun mu ?
     */
    if (strlen($password1) < 4) {
        /**
         * Hata bulduk.
         * Şifre 4 karakter yada daha küçük.
         */
        $error = true;
        $errors[] = 'Şifre en az 5 karakter olmalıdır.';
    }

    /**
     * Şu ana kadar eğer hiçbir hata ile karşılaşmadıysak
     * Ekleme işlemini yapacağız.
     * Eğer hata varsa ekleme işlemini yapmayacağız.
     *
     * Burada kafanız karışmasın.
     * $error ın ilk değeri false idi. Yani hata yok demekti.
     * Eğer hiç hata bulamadıysak değeri hala false kalacak.
     *  if de başında ! işarati değeri ters çevirecek.
     * Eğer hiç hata bulamazsak $error değeri false 'tur. Ama !$error un değeri TRUE dur.
     * true olunca if in içerisine girecek. ve Register işlemini yapacak.
     *
     * Eğer hata bulursak $error true olacak, !$error ise false olacak. Dolayısıyla if in içine girmeyecek.
     *
     */
    if ((!$error) && $_POST['g-recaptcha-response']!="") {
    $secret = '6Lfw-WYUAAAAAJfj0XCWnApLeT174nIY1SB9nh82';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success){
        $name = $db->quote($name);
        $nick = $db->quote($nick);
        $email = $db->quote($email);
        $password = md5($password1);

        $sorgu = "INSERT INTO user (name,nick,email,password,avatar) VALUES ($name,$nick,$email,'$password','defaultavatar.png')";

        $db->query($sorgu);
        header("location: index.php?type=success");
        exit;


    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="style/toastr.css" rel="stylesheet"/>
<script src="style/toastr.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kayıt Ol</title>
</head>
<body>
<div class="container">
 <h3>FACE2FIGHT KAYIT FORMU</h3>
 <form class="kayitform" method="post" action="register.php">
   <div class ="baslik">
   <label>Ad - Soyad :</label>
   <input type="text" name="name" id="name" placeholder="Adınız" value="<?php echo $name;?>">
   </div>
   <div class = "baslik">
    <label>Nickname  :</label>
    <input type="text" name="nick" id="nick" placeholder="Nickname" value="<?php echo $nick;?>">
   </div>
   <div class = "baslik">
     <label>E-Mail Adresi :</label>
     <input type="email" name="email" id="email" placeholder="Mail Adresiniz" value="<?php echo $email;?>">
   </div>
   <div class = "baslik">
    <label>Şifre :</label>
    <input type="password" id="password1" name="password1" placeholder="Şifre" value="<?php echo $password1;?>">
   </div>
   <div class = "baslik">
   <label>Şifre Tekrar :</label>
   <input type="password" id="password2" name="password2" placeholder="Şifre" value="<?php echo $password1;?>">
   </div>
   <div class = "baslik">
   <div class="g-recaptcha" data-theme="light" style="transform:scale(0.75);-webkit-transform:scale(0.75);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="6Lfw-WYUAAAAAHUCRtfMzSS1ldajOHBrUbWsh_Zt"></div>
   </div>
   <button type="submit" class="kayitbuton">Kayıt İşlemini Tamamla</button>
       </form>
<?php
if ($_POST) {
                /**
                 * Hata durumunu kontrol et.
                 */
                if ($error) {
                    $totalError = count($errors);
echo "<script type='text/javascript'>
 toastr.error(' $totalError Hata bulundu. Lütfen bu hataları giderin ve tekrar deneyin.')
    </script>";
                    /**
                     * Tek tek hataları ekrana yaz.
                     */
                    foreach ($errors as $err) {
                      echo "<script type='text/javascript'>
                       toastr.error('$err')
                          </script>";
                    }
                }
            }
            ?>
</div>
</body>
</html>
