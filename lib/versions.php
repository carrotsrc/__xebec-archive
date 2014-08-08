<?php
	include('lib/archives.php');
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

	function version_db_deprecate($vid, $value, $db)
	{
		return db_query("UPDATE `versions` SET `deprecated`='$value' WHERE `id`='$vid';", $db);
	}

	function version_db_add_archive($aid, $vid, $db)
	{
		if(!db_query("INSERT INTO `version_archive` (`vid`, `aid`) VALUES ('$vid', '$aid')", $db))
			return false;

		return true;
	}

	function version_routine_remove_archive($vid, $db)
	{

		$archive = db_query("SELECT `version_archive`.*, `archives`.`archive` FROM `version_archive` JOIN `archives` ON `archives`.`id`=`version_archive`.`aid` WHERE `vid`='$vid'", $db);
		if(!$archive)
			return false;

		$aid = $archive[0]['aid'];

		db_query("DELETE FROM `version_archive` WHERE `vid`='$vid' AND `aid`='$aid'", $db);

		if(!archive_db_remove($aid, $db))
			return false;

		return $archive[0]['archive'];

	}

	function version_routine_add_archive($archive, $vid, $db)
	{
		if(!$aid = archive_db_add($archive, $db))
			return false;

		return version_db_add_archive($aid, $vid, $db);
	}
?>
