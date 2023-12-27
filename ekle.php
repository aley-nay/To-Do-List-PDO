<?php

require_once 'config.php';
require_once 'dbconnect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Yapılacak Listesi</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class="tema mini-modal">
		<div class="hero">
		<h2>Ekle</h2>
	</div>
<form action="ekle.php" method="post">
	<input type="text" name="fbaslik">
	<input type="text" name="fdetay">
	<button class="buton" type="submit">ekle</button>
</form>
</div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $veri = array(
        'baslik' => isset($_POST['fbaslik']) ? trim($_POST['fbaslik']) : '',
        'detay'  => isset($_POST['fdetay']) ? trim($_POST['fdetay']) : ''
    );

    if (!empty($veri['baslik']) && !empty($veri['detay'])) {
        $db = new connectDB();

        if ($db->ekle($veri)) {
            echo "Başarıyla eklendi!";
        } else {
            echo "Ekleme başarısız!";
        }
    } else {
        echo "Lütfen boş alan bırakmayın.";
    }
}
?>



