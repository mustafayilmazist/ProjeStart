<?php 

require_once 'system/MConsts.php';
require_once 'system/MForm.php';
require_once 'system/MFunctions.php';
require_once 'system/MUpload.php';
require_once 'system/MDatabase.php';

if (!get("url")) {

	$file = "anasayfa";

}else{

	$file = get("url");

}

$file ="app/". $file .".php";

if ( !file_exists( $file )) {
	
	echo "<p>Sayfa Yok..!</p>";
	exit();
}

require $file;