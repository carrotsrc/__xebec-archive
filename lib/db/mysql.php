<?php
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
?>
