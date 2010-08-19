<?php

//include 'lib/F1.php';
require_once 'lib/F3.php';

function render() { echo F3::serve('layout.htm'); }

F3::config(".f3.ini");

F3::route("GET /captcha",    ':captcha');
F3::route("GET /",           ':home');
F3::route("GET /min",	     ':minified',3600);

F3::run();

?>

