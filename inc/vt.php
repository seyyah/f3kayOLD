<?php
$sunucu 		= 	"localhost";
$vtkullanici	= 	"test";
$vtsifre 		= 	"secret";
$vtadi			=	"test";

$vtbaglanti 	=	@mysql_connect($sunucu,$vtkullanici,$vtsifre) 
					or die("<center><font color=\"red\"><h1>MySql Sunucusuna Bağlanılamıyor!<br>Lütfen Bağlantı Ayarlarınızı Kontrol Ediniz</h1></font><br><b>Hata Mesajı :</b>".mysql_error()."</center>");
$vtsec 			= 	@mysql_select_db($vtadi,$vtbaglanti);
if(!$vtsec){
	die('<center><font color="red"><h1>Veri Tabanına Bağlanılamıyor!<br>L&uuml;tfen Bağlantı Ayarlarını Kontrol Ediniz</h1></font><br><b>Hata Mesajı :</b>"'.mysql_error().'</center>');
}

//mysql_query("SET NAMES 'utf8'");
//mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");

?>
