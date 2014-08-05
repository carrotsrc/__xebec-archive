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
?>
