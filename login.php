<?php 	include 'config.php';

//session başlatma

session_start();

ob_start();	

if (isset($_POST["admingiris"]))  {

//tanımlamalar

$kullanici_mail=$_POST["kullanici_mail"];

$kullanici_password=md5( $_POST["kullanici_password"]);

  //verş çekme

$kullanicisor=$db->prepare("SELECT * FROM kullanici where mail=:mail
	and pass=:pass ");

$kullanicisor->execute(array(

  'mail' => $kullanici_mail,

  'pass' => $kullanici_password

));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

  //saydırma

$say=$kullanicisor->rowCount();

  //boş alan kontrol

if (strlen($_POST["kullanici_mail"] && $_POST["kullanici_password"])<1) {

	header("Refresh: 2; url=login=?giris=basarisiz");

	echo "<script>
alert ('boş alan bırakma')
</script>";

}

else {

//veri kontrol

if ($say == 1) {

$_SESSION["oturum"]=$kullanicicek["id"];

header("Refresh: 2; url=index.php?giris=basarili");

echo "<script>
alert ('giriş başarılı')
</script>";

}

else {

header("Refresh: 2; url=login.php?login=?giris=basarisiz");

echo "<script>
alert ('başarısız')
</script>"; } #header else bitiş

} #else bitiş

} #admin giriş bitiş

//oturum varsa ve login.php ye girdiyse ana sayfaya atma

if (isset($_SESSION["oturum"])) {

header("location:index.php?durum=izinli");

}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 		<link rel="stylesheet" type="text/css" href="login.css">

 	<title></title>
 </head>
 <body>
 
<div class="login-page">
  <div class="form">
   
    <form class="login-form" method="POST" >
 	<input type="text" name="kullanici_mail" placeholder="username">
 	<input type="password" name="kullanici_password" placeholder="password">
 	<button name="admingiris" class="button">giriş yap</button></form>
            <br> <a href="register.php" style="color: #3d405b;"> <span >Kayıt Ol</span></a>
</div></div> </body>
 </html>