<?php
	function collection_db_exists($collection, $db)
	{
		if(!db_query("SELECT `id` FROM `collections` WHERE `collection`='$collection'", $db))
			return false;

		return true;
	}

	function collection_db_get_all($db, $start = null, $count = null)
	{
		$sql = "SELECT * FROM `collections`";
		if($start != null) {
			if($count == null)
				$count = 15;
			$sql .= "LIMIT $start, $count";
		}
		$r = null;
		if(!$r = db_query($sql, $db))
			return null;

		return $r;
	}

	function collection_db_get_details($ref, $db)
	{
		$sql = "SELECT * FROM `collections` WHERE ";
		if(is_numeric($ref))
			$sql .= "`id` = '$ref'";
		else
			$sql .= "`collection`='$ref'";

		return db_query($sql, $db);
	}

	function collection_db_add($name, $db)
	{
		if(collection_db_exists($name, $db))
			return false;

		return db_query("INSERT INTO `collections` (`collection`) VALUES ('$name')", $db);
	}

	function collection_routine_package_exists($package, $collection, $db)
	{
		$sql = "SELECT `packages`.`id` FROM `packages` JOIN `collection_package` ON `packages`.`id` = `collection_package`.`pid`";
		$sql .= " WHERE `packages`.`name`='$package' AND `collection_package`.`cid`='$collection'";
		if(!db_query($sql, $db))
			return false;

		return true;
	}

	function collection_routine_add_package($package, $collection, $db)
	{
		return db_query("INSERT INTO `collection_package` (`cid`,`pid`) VALUES ('$collection', '$package')", $db);
	}

	function collection_routine_get_packages($collection, $db)
	{
		$sql = "SELECT * FROM `packages` JOIN `collection_package` ON `packages`.`id` = `collection_package`.`pid`";
		$sql .= " WHERE `collection_package`.`cid`='$collection'";
		return db_query($sql, $db);
	}

?>
