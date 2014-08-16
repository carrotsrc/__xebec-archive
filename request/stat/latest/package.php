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
	include('lib/packages.php');
	$collection = collection_db_get_details($collection, $db);
	$collection = $collection[0];
	$package = collection_routine_get_package($tokens[0], $collection['id'], $db);
	$versions = package_db_get_versions($package[0]['id'], $db);

	if(!$versions)
		echo "<error>No versions</error>";
	else
		encode_section('versions', $versions, array('id', 'created'));

?>
