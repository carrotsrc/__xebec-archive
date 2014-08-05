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
		$db->insert_id;
	}
?>
