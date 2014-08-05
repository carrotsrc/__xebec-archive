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

	function db_query($query, $db)
	{
		$r = $db->query($query);
		if(!$r)
			return false;
		$rows = array();

		while(($t = $db->fetch_assoc($r)) != NULL)
			$rows[] = $t;
		
		return $t;
	}

	function db_last_id($db)
	{
		$db->insert_id;
	}
?>
