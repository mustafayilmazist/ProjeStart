<?php 

class MUpload
{
	private $file; 
	public $yuklenen;

	public function __construct($param)
	{
		$this->file=$param;
	}
	private function ad(){
		$ad_uzanti = explode(".",$this->file["name"]);
		$sadece_ad = "";
		for ($i=0; $i<count($ad_uzanti)-1; $i++) { 
			$sadece_ad = $sadece_ad ."". $ad_uzanti[$i] ."_";
		}
		return $sadece_ad;
	}
	private function uzanti()
	{
		$ad_uzanti = explode(".",$this->file["name"]);
		$sadece_uzanti = $ad_uzanti[count($ad_uzanti)-1];
		return $sadece_uzanti;
	}
	private function rastgeleDeger(){
		$zaman = time();
		$randomm = rand(1,10000);
		$kimlik = uniqid();
		$sonuc = $zaman ."_". $randomm ."_". $kimlik;
		return $sonuc;
	}
	private function temizle($param)
	{
		$eski = ["ç","Ç","ı","İ","ğ","Ğ","ş","Ş","ü","Ü","ö","Ö",".","-"," "];
		$yeni = ["c","C","i","I","g","G","s","S","u","U","o","O",".","-"," "];
		$param = str_replace($eski, $yeni, $param);
		$param = strtolower($param);
		return $param;
	}
	public function yukle($yol="")
	{
		$ad = $this->ad();
		$uzanti = $this->uzanti();
		$yeni_ad = $this->temizle($ad);
		$son_ad= $yeni_ad ."_". $this->rastgeleDeger() .".". $uzanti;
		$son = $yol ."". $son_ad;
		$yukle = move_uploaded_file($this->file["tmp_name"], $son);
		if ( $yukle ) {
			$this->yuklenen = $son_ad;
			return true;
		}else{
			return false;
		}
		
	}
}
