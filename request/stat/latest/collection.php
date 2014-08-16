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
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates($limit, $collection, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	} else {
		include('request/stat/latest/package.php');
	}
?>
