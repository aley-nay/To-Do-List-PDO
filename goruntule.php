<?php
require_once("config.php");
require_once("dbconnect.php");

$connectDB = new connectDB();
$query = "SELECT id, baslik, detay from yapilacak_listesi";

$data = $connectDB->fetchAllData($query);

if ($data == FALSE) {
    echo "errr";
} else {


?>

<!DOCTYPE html>
<html>
<head>
	<title>Yapılacak Listesi</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<div class="tema">
	<div class="hero">
		<h2>Yapılacak Listesi</h2>
		<a class="renk" href="ekle.php">+ Ekle</a>
	</div>
	<?php
		foreach ($data as $kayit) { 
?>

	<div class="is">
		<div class="is_baslik">
			<h3><?php echo $kayit["baslik"]; ?></h3>
		</div>
		<div class="is_detay">
			<p><?php echo $kayit["detay"]; ?></p>
		</div>
		<div class="islem_butonlari">
			<a class="buton" href='sil.php?id=<?php echo $kayit["id"]; ?>'>sil</a>
			<a class="buton" href='guncelle.php?id=<?php echo $kayit["id"]; ?>'>güncelle</a>
		</div>
	</div>



	<?php
} }
?>
</div>
</body>
</html>