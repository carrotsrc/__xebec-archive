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
	function db_connect()
	{
		global $repo_config;
		$mysqli = new mysqli("localhost", $repo_config['dbuser'],
					$repo_config['dbpass'], $repo_config['db']);

		if($mysqli->connect_errno) {
			die("Failed to connect: {$mysqli->connect_error} ({$mysqli->connect_errno})");
		}

		return $mysqli;
	}

	function db_query($query, $db)
	{
		$r = $db->query($query);
		if($r === true || $r === false)
			return $r;

		if($r->num_rows == null)
			return false;

		$rows = array();

		while(($t = $r->fetch_assoc()) != NULL)
			$rows[] = $t;
		
		return $rows;
	}

	function db_last_id($db)
	{
		return $db->insert_id;
	}
?>
