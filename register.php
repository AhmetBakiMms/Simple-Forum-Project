<?php


include 'config.php';

   


ob_start();
session_start();





//kayıt kısmı
if (isset($_POST['adminkayıtol'])) {
  $kullanici_username= strip_tags(htmlspecialchars($_POST['kullanici_mail']));
  $kullanici_password= strip_tags(htmlspecialchars(md5($_POST['kullanici_password'])));
$kullanicisor=$db->prepare("SELECT * FROM kullanici where mail=:mail");
  $kullanicisor->execute(array(
    'mail' => $kullanici_username
    ));

$say=$kullanicisor->rowCount();


// insert veri yazma komutu
 
if    (strlen($kullanici_username && $kullanici_password )<1)  {
    echo "<script>
alert('boş alan Kontrol ediniz');
    </script>";
} 
elseif(strlen($_POST["kullanici_password"])<5)
     {
      echo "<script>

alert('Şifreniz 5 karakterden küçük olamaz');
    </script>";



  
  }
  elseif ($say>0) {
  echo "<script>
alert('Aynı Mailde Kayıt var');
    </script>";

  }
elseif ($_POST["kullanici_password"] == $_POST["kullanici_password_re"]) {
  




  $kaydet=$db->prepare("INSERT into kullanici set

 mail=:kullanici_mail,

 pass=:kullanici_password,
  yetki=:kullanici_yetki

");
$insert=$kaydet->execute(array(
    'kullanici_mail' => $kullanici_username,
    'kullanici_password' => $kullanici_password,
    'kullanici_yetki' => 2

));

if ($insert) {
  echo "<script>
alert('Başarıyla Kayıt Olundu');
    </script>";}
else {
    header("Location:login.php?kayit=basarisiz");
}


}
else {
 echo "<script>
alert('Şifreler Eşleşmiyor');
    </script>";
}
}








?>


<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta name="viewport" content="width=device-width">

<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="login-page">
  <div class="form">
   
    <form class="login-form" method="POST" >

      <input type="text" placeholder="username" name="kullanici_mail">
      <input type="password" placeholder="Password" name="kullanici_password" id ="myInput"> 

              <input type="password" placeholder="Re-Password" name="kullanici_password_re" id ="myInput"> 
 


     
      <button name="adminkayıtol" class="button">sign up</button><center>
           <br> <a href="login.php" style="color: #3d405b;"> <span >Giriş Yap</span></a>
 </center>
    </form>
</div>


</body>
</html>