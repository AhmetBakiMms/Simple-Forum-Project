<?php 

include 'header.php';
 ?>


<div class="container mt-2">
	<div class="row">
		
<div class="col-12 text-light p-2 "  ><h4 class="text-light  d-inline">Son Konular</h4>	<a href="new.php" style="float: right;background: #0a0c0d;color: white" class="btn " >Add</a>
</div>

<?php 



$query=$db->prepare("SELECT * from konu order by id desc LIMIT 8");
$query->execute(array());
foreach ($query as $cek ) {


 ?>
	<div class="col-12 text-light " style="background: #0a0c0d" >
	
<span><?php echo $cek["id"] ?> | </span>
			<img src="pp.png" style="height: 40px;border-radius: 30px;margin-right: 20px;margin: 10px">
		<a href ="p.php?id=<?php echo $cek["seflink"] ?>" style="color: white"><span id="demo"><?php echo kisalt($cek["baslik"],30) ?></span></a>	

			</span>
	</div>

<?php } ?>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>



</script>

<?php include 'footer.php'; ?>

