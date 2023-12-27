<?php

class connectDB{
	private $db = null;
	#public $db = null;

	public function __construct(){
		$this->openDB();
	}


	private function openDB(){
		try{
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		}catch(PDOException $e){
			echo "Error".$e->getMessage();
		}
	}


	public function sqlExec($sql){
		$ready = $this->db->prepare($sql);
		try{
			$ready->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}

	public function fetchAllData($sql){
		try{
			$selectDB = $this->db->prepare($sql);
			$selectDB->execute();
			$data = $selectDB->fetchAll(PDO::FETCH_ASSOC);
			if($selectDB->rowCount()<=0){
				return false;
			}
			return $data;

		}catch(PDOException $e){
			return null;
		}
	}

	public  function fetchData($sql){
		
		try{
			$dbSelect =  $this->db->prepare($sql);	
			$dbSelect->execute();
			// FETCH_ASSOC tablo field isimleriyle verileri getirir
			$data=$dbSelect->fetch(PDO::FETCH_ASSOC);

			if($dbSelect->rowCount() <= 0){
				return false;
			}
			
			return $data;
			
		}catch(PDOException $e){
			return null;
		}				
	}


/*
	public static function urunekle($params){
        extract($params);
        $db = new DBConnect();
        $sql = "INSERT INTO yapilacaklar_listesi (baslik, detay) VALUES ($baslik, $detay)";
        $result=$db->sqlExec($sql);
        return $result;
     }
  */
     
     	public function sil($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM yapilacak_listesi WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Başarıyla silindiğini belirtmek için true döndürüyoruz.
        } catch (PDOException $e) {
            die("Silme hatası: " . $e->getMessage());
        }
    }

    public function ekle($veri) {
        try {
            $stmt = $this->db->prepare("INSERT INTO yapilacak_listesi (baslik, detay) VALUES (:fbaslik, :fdetay)");
            $stmt->bindParam(':fbaslik', $veri['baslik']);
            $stmt->bindParam(':fdetay', $veri['detay']);
            $stmt->execute();

            return true; // Başarıyla eklendiğini belirtmek için true döndürüyoruz.
        } catch (PDOException $e) {
            die("Ekleme hatası: " . $e->getMessage());
        }
    }

    public function guncelle($veri) {
	    try {
	        $stmt = $this->db->prepare("UPDATE yapilacak_listesi SET baslik = :baslik, detay = :detay WHERE id = :id");
	        $stmt->bindParam(':id', $veri['id'], PDO::PARAM_INT);
	        $stmt->bindParam(':baslik', $veri['baslik']);
	        $stmt->bindParam(':detay', $veri['detay']);
	        $stmt->execute();

	        return true; // Başarıyla güncellendiğini belirtmek için true döndürüyoruz.
	    } catch (PDOException $e) {
	        // Log the error or handle it appropriately
	        die("Güncelleme hatası: " . $e->getMessage());
	    }
	}


     /*
     public static function urunguncelle($params){
        extract($params);
        $db = new DBConnect();
        $sql = "UPDATE urunler SET urun_adi='$urun_adi', urun_fiyati=$urun_fiyati, urun_stok=$urun_stok WHERE urun_id=$urun_id";
        $result=$db->sqlExec($sql);
        return $result;
	}*/


}






?>