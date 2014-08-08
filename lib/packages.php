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

	function package_db_modify_details($pid, $name, $desc, $db)
	{
		return db_query("UPDATE `packages` SET `name`='$name', `desc`='$desc' WHERE `id`='$pid'", $db);
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


	function package_db_package_version_exists($version, $package, $db)
	{
		$sql = "SELECT * FROM `versions` JOIN `package_version` ON `package_version`.`vid`=`versions`.`id` ";
		$sql .= " JOIN `packages` ON `packages`.`id`=`package_version`.`pid` WHERE ";
		$sql .= "`package_version`.`pid`='{$package}' AND ";
		$sql .= "`package_version`.`vid`='{$version}'";
		if(!db_query($sql, $db))
			return false;

		return true;
	}

	function package_db_add_version($vid, $pid, $db)
	{
		return db_query("INSERT INTO `package_version` (`pid`,`vid`) VALUES ('$pid', '$vid')", $db);
	}

	function package_db_remove_version($vid, $pid, $db)
	{
		return db_query("DELETE FROM `package_version` WHERE `pid`='$pid' AND `vid`='$vid'", $db);
	}

	function package_db_get_versions($package, $db, $archives = false)
	{
		$sql = "SELECT `versions`.*";
		if($archives)
			$sql .= ", `archives`.`archive`";

		$sql .= " FROM `versions` JOIN `package_version` ON `versions`.`id`=`package_version`.`vid` ";
		if($archives) {
			$sql .= "LEFT JOIN `version_archive` ON `version_archive`.`vid`=`package_version`.`vid` ";
			$sql .= "LEFT JOIN `archives` ON `version_archive`.`aid`=`archives`.`id` ";
		}
		$sql .= "WHERE `package_version`.`pid` = '$package' ";
		$sql .= "ORDER BY `versions`.`major` DESC, `versions`.`minor` DESC, `versions`.`maintenance` DESC, `versions`.`stage` DESC";
		return db_query($sql, $db);
	}

	function package_db_get_scm($package, $db)
	{
		$sql = "SELECT `scm`.*";
		$sql .= " FROM `scm` JOIN `package_scm` ON `scm`.`id`=`package_scm`.`sid` ";
		$sql .= "WHERE `package_scm`.`pid` = '$package' ";

		return db_query($sql, $db);
	}

	function package_db_add_scm($package, $url, $db)
	{
		$sql = "INSERT INTO `scm` (`url`) VALUES ('$url')";
		if(!db_query($sql, $db))
			return false;

		return db_last_id($db);
	}

	function package_db_scm_exists($package, $scm, $db)
	{
		$sql = "SELECT `scm`.`id`";
		$sql .= " FROM `scm` JOIN `package_scm` ON `scm`.`id`=`package_scm`.`sid` ";
		$sql .= "WHERE `package_scm`.`pid` = '$package' ";
		if(is_numeric($scm))
			$sql .= "AND `package_scm`.`sid`='$scm'";
		else
			$sql .= "AND `scm`.`url`='$scm'";
		if(!db_query($sql, $db))
			return false;

		return true;
	}

	function package_db_add_package_scm($package, $sid, $db)
	{
		$sql = "INSERT INTO `package_scm` (`pid`, `sid`) VALUES ('$package', '$sid')";
		return db_query($sql, $db);
	}

	function package_db_remove_scm($scm, $db)
	{
		return db_query("DELETE FROM `scm` WHERE `id`='$scm'", $db);
	}

	function package_db_remove_package_scm($package, $scm, $db)
	{
		return db_query("DELETE FROM `package_scm` WHERE `pid`='$package' AND `sid`='$scm'", $db);
	}

	function package_routine_add_version(array $version, $stage, $package, $archive, $db)
	{
		$package = package_db_get_details($package, $db);
		if(!$package)
			return false;

		if(package_db_version_exists($version, $stage, $package['id'], $db))
			return false;

		$vid = null;
		if(!($vid = version_db_add($version, $stage, $db)))
			return false;

		if(!package_db_add_version($vid, $package['id'], $db))
			return false;

		if(!version_routine_add_archive($archive, $vid, $db))
			return false;


		return true;
	}

	function package_routine_add_scm($url, $package, $db)
	{
		$id = package_db_add_scm($package, $url, $db);
		if(!$id)
			return false;

		return package_db_add_package_scm($package, $id, $db);
	}

	function package_routine_remove_scm($package, $scm, $db)
	{
		if(!package_db_scm_exists($package, $scm, $db))
			return false;

		if(!package_db_remove_scm($scm, $db))
			return false;

		if(!package_db_remove_package_scm($package, $scm, $db))
			return false;

		return true;
	}

	function package_routine_remove_version($collection, $package, $pid, $vid, $db)
	{
		if(!package_db_package_version_exists($vid, $pid, $db))
			return false;

		version_db_remove($vid, $db);
		package_db_remove_version($vid, $pid, $db);
		$archive = version_routine_remove_archive($vid, $db);
		if($archive)
			archive_routine_unlink($collection, $package, $archive);
	}

	function package_routine_updated($package, $db)
	{
		$s = "`id`";
		if(!is_numeric($package))
			$s = "`name`";

		db_query("UPDATE `packages` SET `updated`=NOW() WHERE $s='$package'", $db);
	}
?>
