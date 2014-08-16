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
	$limit = 10;

	/* set the limit of the number of packages to pull */
	if(isset($_GET['limit']))
		$limit = $_GET['limit'];

	include('lib/collections.php');
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates($limit, null, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	} else {
		$collection = $tokens[0];
		$tokens = array_slice($tokens, 1);
		include('request/stat/latest/collection.php');
	}
?>
