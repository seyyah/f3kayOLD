<?php

function tc2info($tc) {
	$result = get_web_page( "http://www.isimtescil.net/UyeKayitKisa.aspx?Type=ControlTCNo&TCNo=" . $tc );
	/*if ( $result['errno'] != 0 )
	   echo "... error: bad url, timeout, redirect loop ...";

	if ( $result['http_code'] != 200 )
	    echo "... error: no page, no permissions, no service ...";*/

	$page = $result['content'];
	
	list($IsValid, $ErrorCode, $NameSurname) = preg_split("/[\s]*[|][\s]*/", $page);
	$info = array("IsValid"=>$IsValid, "ErrorCode"=>$ErrorCode, "NameSurname"=>$NameSurname);
	return $info;
}

/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 */
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8"));
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

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
$tc = F3::get('PARAMS["tc"]');
$info = tc2info($tc);
$info = array_map("utf8_encode", $info);
//print_r( $info);
//echo json_encode($info);
echo JEncode($info);
?>
