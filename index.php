<?php 
require_once 'system/sabtiler.php';
require_once 'system/fonksiyonlar.php';
require_once 'system/upload.php';
require_once 'system/db.php';
$file = !g("url")?"anasayfa":g("url");
$file ="app/". $file .".php";
if ( !file_exists( $file )) {
	echo "<p>Sayfa Yok..!</p>";
	exit();
}
$db= new Db($server,$dbname,$dbuser,$dbpassword,$charset);
require $file;