<?php
require_once 'config.php';
require_once 'dbconnect.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $db = new connectDB();

    if($db->sil($id)) {
        echo "Veri başarıyla silindi.";
    } else {
        echo "Veri silinirken bir hata oluştu.";
    }
} else {
    echo "Geçersiz veya eksik ID parametresi.";
}
?>
