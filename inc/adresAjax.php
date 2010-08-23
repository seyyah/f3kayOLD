<?php

	function JEncode($node){
	    if (version_compare(PHP_VERSION,"5.2","<"))
	    {    
	        require_once("JSON.php");
	        $json = new Services_JSON();
	        $data=$json->encode($node);
	    } else
	    {
	        $data = json_encode($node);
	    }
	    return $data;
	}

	require_once('vt.php');
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");

	$tt = F3::get('PARAMS["parameter"]');
	$param = preg_split("/[\s]*[,][\s]*/", $tt);

	$getir = $param[0];//$_GET['getir'];
	$id    = $param[1]; //"208";//$_GET['id'];

	$tablo = "adres_" . $getir;
	$secim = $getir;

	if(!$id)		$id = 0;
	if($getir == "il")	$xx="ulke";
	if($getir == "ilce")	$xx="il";
	if($getir == "semt") 	$xx="ilce";

	if($getir == "ulke"){
		$x1 = "SELECT $secim,no from $tablo  order by sira";
		$vtSorgu = mysql_query("SELECT $secim,no from $tablo order by ulke");	
	} else {
		$x2 = "SELECT $secim,no from $tablo where $xx=$id order by sira";
		$vtSorgu = mysql_query("SELECT $secim,no from $tablo where $xx=$id order by $secim");
	}
	
	//echo $x2;
	while ($listele=mysql_fetch_array($vtSorgu)){
		$node[$secim] = $listele[$secim];
		$node['no'] = $listele['no'];
		$t[] = $node;
	}
	
	echo JEncode($t);
?>
