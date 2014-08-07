<?php
	function package_db_add($name, $desc, $db)
	{
		if(!db_query("INSERT INTO `packages` (`name`, `desc`) VALUES ('$name', '$desc')", $db))
			return false;

		return db_last_id($db);
	}

	function package_db_get_details($package, $db)
	{
		$sql = "SELECT * FROM `packages` WHERE ";
		if(is_numeric($package))
			$sql .= " `id`='$package'";
		else
			$sql .= " `name`='$package'";

		if(($r = db_query($sql, $db)))
			return $r[0];

		return false;
	}

	function package_db_remove($package, $db)
	{
		$sql = "DELETE FROM `packages` WHERE ";
		if(is_numeric($package))
			$sql .= " `id`='$package'";
		else
			$sql .= " `name`='$package'";

		return db_query($sql, $db);
	}

	function package_db_version_exists(array $version, $stage, $package, $db)
	{
		$sql = "SELECT * FROM `versions` JOIN `package_version` ON `package_version`.`vid`=`versions`.`id` ";
		$sql .= " JOIN `packages` ON `packages`.`id`=`package_version`.`pid` WHERE ";
		$sql .= "`versions`.`major`='{$version[0]}' AND ";
		$sql .= "`versions`.`minor`='{$version[1]}' AND ";
		$sql .= "`versions`.`maintenance`='{$version[2]}' AND ";
		$sql .= "`versions`.`stage`='{$stage}' AND ";
		$sql .= "`package_version`.`pid`='{$package}'";
		if(!db_query($sql, $db))
			return false;

		return true;
	}

	function package_db_add_version(array $version, $stage, $package, $db)
	{
		$sql = "INSERT INTO `versions` (`major`,`minor`,`maintenance`,`stage`, `created`, `updated`) ";
		$sql .= "VALUES ('{$version[0]}', '{$version[1]}', '{$version[2]}', '$stage', NOW(), NOW())";

		if(!db_query($sql, $db))
			return null;

		return db_last_id($db);
	}

	function package_db_add_package_version($vid, $package, $db)
	{
		return db_query("INSERT INTO `package_version` (`pid`,`vid`) VALUES ('$package', '$vid')", $db);
	}

	function package_db_get_versions($package, $db, $archives = false)
	{
		$sql = "SELECT `versions`.*";
		if($archives)
			$sql .= ", `archives`.*";

		$sql .= " FROM `versions` JOIN `package_version` ON `versions`.`id`=`package_version`.`vid` ";
		if($archives) {
			$sql .= "LEFT JOIN `version_archive` ON `version_archive`.`vid`=`package_version`.`vid` ";
			$sql .= "LEFT JOIN `archives` ON `version_archive`.`aid`=`archives`.`id` ";
		}
		$sql .= "WHERE `package_version`.`pid` = '$package'";
		return db_query($sql, $db);
	}

	function package_routine_add_version(array $version, $stage, $package, $archive, $db)
	{
		$package = package_db_get_details($package, $db);
		if(!$package)
			return false;

		if(package_db_version_exists($version, $stage, $package['id'], $db))
			return false;

		$vid = null;
		if(!($vid = package_db_add_version($version, $stage, $package['id'], $db)))
			return false;

		if(!package_db_add_package_version($vid, $package['id'], $db))
			return false;

		return true;
	}
?>
