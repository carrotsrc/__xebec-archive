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
	encode_section("package", $package, array('id', 'cid', 'pid'));
	$package = $package[0];
	$trial['package'] = $package['name'];

	$versions = package_db_get_versions($package['id'], $db, true);
	if($versions)
		encode_section("versions", $versions, array('id'));
	
	$scm = package_db_get_scm($package['id'], $db);
	if($scm)
		encode_section("scm", $scm, array('id'));
?>
