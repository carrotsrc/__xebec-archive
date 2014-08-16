<?php
/*
* Copyright 2014, Zunautica Initiatives Ltd.
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
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

	function collection_db_remove_package($package, $collection, $db)
	{
		return db_query("DELETE FROM `collection_package` WHERE `cid`='$collection' AND `pid`='$package'", $db);
	}

	function collection_routine_add_directory($name)
	{
		global $repo_config;
		$path = $repo_config['docroot']."/repo/$name";
		return mkdir($path);
	}

	function collection_routine_add_package_directory($package, $collection)
	{
		global $repo_config;
		$path = $repo_config['docroot']."/repo/$collection/$package";
		return mkdir($path);
	}

	function collection_routine_package_exists($package, $collection, $db)
	{
		$sql = "SELECT `packages`.`id` FROM `packages` JOIN `collection_package` ON `packages`.`id` = `collection_package`.`pid`";
		if(!is_numeric($collection))
			$sql .= " JOIN `collection` ON `collection`.`collection`=`collection_packages`.`cid`";
		$sql .= " WHERE `packages`.`name`='$package' AND ";
		
		if(is_numeric($collection))
			$sql .= "`collection_package`.`cid`='$collection'";
		else
			$sql .= "`collection`.`collection`='$collection'";

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

	function collection_routine_get_package($package, $collection, $db)
	{
		$sql = "SELECT * FROM `packages` JOIN `collection_package` ON `packages`.`id` = `collection_package`.`pid`";
		$sql .= " WHERE `collection_package`.`cid`='$collection' AND ";
		if(is_numeric($package))
			$sql .= "`packages`.`id`='$package'";
		else
			$sql .= "`packages`.`name`='$package'";
		return db_query($sql, $db);
	}

	function collection_routine_remove_package($package, $collection, $db)
	{
		global $repo_config;
		if(!($package = collection_routine_get_package($package, $collection['id'], $db)))
			return false;

		$package = $package[0];
		include('lib/packages.php');
		$versions = package_db_get_versions($package['id'], $db);
		$repos = package_db_get_scm($package['id'], $db);

		

		if($repos)
			foreach($repos as $r)
				package_routine_remove_scm($package['id'], $r['id'], $db);
		
		if($versions)
			foreach($versions as $v)
				package_routine_remove_version($collection['collection'], $package['name'], $package['id'], $v['id'], $db);

		rmdir($repo_config['docroot']."/repo/{$collection['collection']}/{$package['name']}");
		package_db_remove($package['id'], $db);
		collection_db_remove_package($package['id'], $collection['id'], $db);
	}

	function collection_routine_package_updates($limit = 10, $collection, $db)
	{
		$sql = "SELECT `collections`.`collection`, `packages`.`name`, `packages`.`updated` FROM `packages` ";
		$sql .= "JOIN `collection_package` ON `packages`.`id` = `collection_package`.`pid` ";
		$sql .= "JOIN `collections` ON `collections`.`id`=`collection_package`.`cid` ";

		if($collection)
			$sql .= "WHERE `collections`.`collection`='$collection' ";
		
		$sql .= "ORDER BY `packages`.`updated` DESC";
		if($limit)
			$sql .= " LIMIT $limit";
		return db_query($sql, $db);
	}


?>
