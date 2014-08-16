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
	include('lib/collections.php');

	if(!isset($tokens[0])) {
		$collections = collection_db_get_all($db);
		encode_section("collections", $collections, array('id'));
	} else {
		$collection = collection_db_get_details($tokens[0], $db);
		if($collection) {
			$collection = $collection[0];
			include('request/browse/packages.php');
		}
		else
			echo "<error>Collection not found</error>";
	}
?>
