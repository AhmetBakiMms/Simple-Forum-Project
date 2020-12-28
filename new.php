<?php include 'header.php'; ?>
<script src="ckeditor/ckeditor.js"></script>

<?php 

//veri sorgulatma
$kullanicisor=$db->prepare("SELECT * FROM kullanici where id=:id ");
$kullanicisor->execute(array(
  'id' => $_SESSION['oturum']
  ));

//saydırma
$say=$kullanicisor->rowCount();

//sessiondaki kullanıcının veri çekme
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


if ($say==0) {

  Header("Location:index.php?durum=basarisiz");
  exit;

}
if (isset($_POST["ekle"])) {
	# code...

$baslik=htmlspecialchars(strip_tags($_POST["baslik"]));
$icerik=$_POST["icerik"];

$usernamecek=$kullanicicek["mail"];
if (strlen($baslik && $icerik)>0) {
$query=$db->prepare("INSERT INTO konu SET
baslik=:baslik,
icerik =:icerik,
konu_ekleyen=:konu_ekleyen,
seflink=:seflink
	");
$insert=$query->execute(array(

'baslik' => $baslik,
'icerik' => $icerik,
'konu_ekleyen'=>$usernamecek,
'seflink'  =>seflink($baslik)."--".rand(0,800).generateRandomString(5)
));
if ($insert) {

	echo "<script>alert('Başarıyla eklendi')</script>";


}

	
}

else {echo "<script>alert('Boş alan bırakmayınız')</script>";}

}
 ?>


<div class="container" style="padding:5px">
	
	<form method="POST">
		<hr>
		<input type="text" name="baslik" placeholder="Konu Başlık" class="form-control"><hr>
<textarea class="form-control" placeholder="Konuyu yazınz" name="icerik" rows="10" style="resize: none;" id="editor1"></textarea><hr>
<button name="ekle" class="btn btn-success">Konuyu Ekle</button>
	</form>
</div>


  <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
<?php include 'footer.php'; ?>