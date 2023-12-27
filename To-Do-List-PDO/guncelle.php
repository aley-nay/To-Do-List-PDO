<?php
require_once 'config.php';

$database = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $gid = $_GET["id"];

    if ($database) {
        $stmt = $database->prepare("SELECT * FROM yapilacak_listesi WHERE id = :id");
        $stmt->bindParam(':id', $gid);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $kayit = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gid = $_GET["id"];
    $gbaslik = $_POST["fbaslik"];
    $gdetay  = $_POST["fdetay"];

    $stmt = $database->prepare("UPDATE yapilacak_listesi SET baslik = :baslik, detay = :detay WHERE id = :id");
    $stmt->bindParam(':id', $gid);
    $stmt->bindParam(':baslik', $gbaslik);
    $stmt->bindParam(':detay', $gdetay);

    if ($stmt->execute()) {
        echo "Güncellendi<br />";
        header("Location: goruntule.php");
        exit();
    } else {
        echo "Hata";
    }
}
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
            <h2>Güncelle</h2>
        </div>
        <form action='guncelle.php?id=<?php echo $gid;?>' method='post'>
            <input type='text' name='fbaslik' value='<?php echo isset($kayit["baslik"]) ? htmlspecialchars($kayit["baslik"]) : ''; ?>'>
            <input type='text' name='fdetay'  value='<?php echo isset($kayit["detay"]) ? htmlspecialchars($kayit["detay"]) : ''; ?>'>
            <button class="buton" type='submit'>güncelle</button>
        </form>
    </div>
</body>
</html>
