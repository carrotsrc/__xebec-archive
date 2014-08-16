<?php
/*
* Copyright 2014, Zunautica Initiatives Ltd.
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/
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
