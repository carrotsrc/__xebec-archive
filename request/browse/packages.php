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
	$trail['collection'] = $collection['collection'];
	if(!isset($tokens[1])) {
		$packages = collection_routine_get_packages($collection['id'], $db);
		encode_section("packages", $packages, array('id', 'cid', 'pid'));
	} else {
		$package = collection_routine_get_package($tokens[1], $collection['id'], $db);
		if($package) {
			include('request/browse/package.php');
		} else
			echo "<error>Package does not exist</error>";
	
	}
?>
