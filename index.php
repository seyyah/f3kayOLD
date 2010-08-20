<?php

//include 'lib/F1.php';
require_once 'lib/F3.php';

function render() { echo F3::serve('layout.htm'); }

F3::config(".f3.ini");

F3::route("GET /captcha",    ':captcha');
F3::route("GET /min",	     ':minified',3600);

F3::route("GET /",           ':home');

F3::route("GET /create",  ':createkul');
F3::route("POST /create", ':savekul');

F3::route("GET /test", "test");
function test() {
	echo F3::serve("example.htm");
}
F3::route("GET /ajax/adresAjax/@parameter", ":adresAjax");
F3::route("GET /ajax/tc/@tc", ":tc");

F3::run();

?>

