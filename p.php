<?php 

include 'header.php';
 ?>


<div class="container mt-2">
	<div class="row">
		
<div class="col-12 text-light p-2 "  >
</div>

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
if (isset($_GET["id"])) {


$id=$_GET["id"];
$query=$db->prepare("SELECT * from konu where seflink=? order by id desc LIMIT 8 ");
$query->execute(array($id));
foreach ($query as $cek ) {


 ?>
	<div class="col-12 text-light " style="background: #0a0c0d" >
	

			<img src="pp.png" style="height: 40px;border-radius: 30px;margin-right: 20px;margin: 10px">
		<a href ="p.php?id=<?php echo $cek["id"] ?>" style="color: white">
			<span id="demo"><?php echo $cek["baslik"] ?></span></a>	<span> | <?php echo $cek["konu_ekleyen"] ?> | </span><span><?php echo $cek["zaman"] ?> | </span>

<div>
	<p class="p-3"><?php echo $cek["icerik"] ?></p>
</div>
			</span>
	</div>

<?php } ?>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>



</script>
<?php 	
} ?>
<?php include 'footer.php'; ?>

