<?php
	include('system/config.php');

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

?>
