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
	include($_SERVER['DOCUMENT_ROOT'].'/system/config.php');

	$repo_config['docroot'] = $_SERVER['DOCUMENT_ROOT'];

	function init_database()
	{
		global $repo_config;

		if(!isset($repo_config['dbms']) || $repo_config['dbms'] == "")
			die("No DBMS specified in the configuration");

		$dir = $repo_config['docroot']."/lib/db/".$repo_config['dbms'].".php";

		if(!file_exists($dir))
			die("No DBMS library found for ".$repo_config['dbms']);
		
		include($dir);
		return db_connect();
	}

	function init_session()
	{
		session_start();
	}
?>
