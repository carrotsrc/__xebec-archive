<?php
	header('Content-Type: application/xml; charset=utf-8');
	if(!isset($tokens[0]))
		die("No encoder specified");

	include('lib/strings.php');
	$enc = $tokens[0];

	if(!isset($tokens[1]))
		$tokens[1] = null;

	$branch = $tokens[1];
	$tokens = array_slice($tokens, 2);
	$trail = array();
	if($enc == 'xml') {
		include('lib/encoder/xml.php');
		echo xml_doc();
	}

	if($branch == 'collections')
		include('request/browse/collections.php');
	else
	if($branch == 'latest')
		include('request/stat/latest.php');

	if(sizeof($trail) > 0) 
		encode_section("trail", array($trail));


	if($enc == 'xml')
		echo xml_end();
?>
