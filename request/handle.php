<?php
	if(!isset($tokens[0]))
		die("No encoder specified");

	include('lib/strings.php');
	$enc = $tokens[0];

	if(!isset($tokens[1]))
		$tokens[1] = null;

	$branch = $tokens[1];
	$tokens = array_slice($tokens, 2);

	if($enc == 'xml') {
		include('lib/encoder/xml.php');
		echo xml_doc();
	}

	if($branch == 'collections')
		include('request/collections.php');

	if($enc == 'xml')
		echo xml_end();

?>
