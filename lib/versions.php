<?php
	function version_db_add(array $version, $stage, $db)
	{
		$sql = "INSERT INTO `versions` (`major`,`minor`,`maintenance`,`stage`, `created`, `updated`) ";
		$sql .= "VALUES ('{$version[0]}', '{$version[1]}', '{$version[2]}', '$stage', NOW(), NOW())";

		if(!db_query($sql, $db))
			return null;

		return db_last_id($db);
	}

	function version_db_remove($vid, $db)
	{
		return db_query("DELETE FROM `versions` WHERE `id`='$vid'", $db);
	}
?>
