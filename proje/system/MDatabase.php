<?php

$db = new MDatabase($su,$va,$ka,$ks);

/**
 * MDatabase, Pdo dan miras alınarak
 * Veritabanı işlemlerini (CRUD) daha kullanışlı hale getirmek için oluşturulmuş
 * bir Veritabanı sınıfıdır
 * sınıftan örnek alırken
 * $db = new MDatabase("sunucu","veritabani_adi","veritabani_kullanici_adi","veritabani_kullanici_şifresi");
 */
class MDatabase extends PDO
{
	/**
	 * [$sql işlenecek olan sql kodu
	 * örnek insert into kisi set kisi_ad=?,kisi_soyad=?]
	 * @var [sql]
	 */
	public $sql;
	/**
	 * [$data sorguya gönderilecek olan veri
	 * örnek array("ahmet emin","üstündağ")]
	 * @var [veri]
	 */
	public $data;
	/**
	 * [__construct pdo üzerinden sunucu ve Veritabanına bağlanma]
	 * @param [string] $sunucu     [sunucu adı]
	 * @param [string] $veritabani_adi [Veritabanı adı]
	 * @param [string] $veritabani_kullanici_adi  [Veritabanı kullanıcı adı]
	 * @param [string] $veritabani_kullanici_şifresi      [Veritabanın kullanıcı şifresi]
	 */
	 /**
	 *[$son_eklenen_id veritabanına eklenen kaydın id değeri]]
	 *@var [integer]
	 */
	 public $son_eklenen_id;

	function __construct($sunucu,$veritabani_adi,$veritabani_kullanici_adi,$veritabani_kullanici_şifresi)
	{
		try{
			parent:: __construct("mysql:host=$sunucu;dbname=$veritabani_adi;charset=utf8",$veritabani_kullanici_adi,$veritabani_kullanici_şifresi);
		}catch( Exception $error ){
			die("Veritabanı Bağlantı Hatası Oluştu !");
		}
	}
	/**
	 * [insert Veritabanına kayıt ekler]
	 * @return [boolen]
	 */
	public function insert(){
		$query =  parent::prepare($this->sql);
		$query->execute($this->data);
		$this->son_eklenen_id = parent::lastInsertId(); // eklenen kaydın id değeri
		return $query;
	}
	/**
	 * [update Veritabanındaki kayıtları günceller]
	 * @return [boolen]
	 */
	public function update(){
		$query =  parent::prepare($this->sql);
		$query->execute($this->data);
		return $query;
	}
	/**
	 * [select Veritabanından kayıtları seçer (listeler)]
	 * @param  string $param [1 ise tek kayıt döndürür, boş ise bbirden fazla kayıt döndürür.]
	 * @return [record/false]
	 */
	public function select($param=""){
		if($param==1){ // eğer $param 1 ise
			$query =  parent::prepare($this->sql);
			$query->execute($this->data);
			if ($query->rowCount()>0) { // eğer kayıt var ise
				$kayit = $query->fetch(PDO::FETCH_OBJ); // tek kaydı seç
				return $kayit; // tek kaydı geri döndür
			}else{
				return false;
			}
		}else{
			$query =  parent::prepare($this->sql);
			$query->execute($this->data);
			if ($query->rowCount()>0) {
				$kayitlar = $query->fetchAll(PDO::FETCH_OBJ); // şarta uyan tum kayıtları seç
				return $kayitlar;		 // sorgudan  dönen tüm kayıtları geri döndür.
			}else{
				return false;
			}
		}
	}
	/**
	 * [delete Veritabanından kayıt siler]
	 * @return [boolean]
	 */
	public function delete(){
		$query =  parent::prepare($this->sql);
		$query->execute($this->data);
		return $query;
	}
}
