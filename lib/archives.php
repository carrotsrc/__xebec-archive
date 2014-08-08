<?php
	function archive_db_add($archive, $db)
	{
		if(!db_query("INSERT INTO `archives` (`archive`) VALUES ('$archive')", $db))
			return false;
		return db_last_id($db);
	}

	function archive_db_remove($aid, $db)
	{
		if(!db_query("DELETE FROM `archives` WHERE `id`='$aid'", $db))
			return false;

		return true;
	}

	function archive_routine_store(array $version, $stage, $collection, $package, $file)
	{
		$ud =$_SERVER['DOCUMENT_ROOT']."/repo/{$collection}/{$package}";
		$base = basename($file['name']);
		$base = explode(".", $base);
		$type = null;
		if(($i = sizeof($base)) > 1) {
			if(sizeof($base) > 2 && $base[$i-2] == "tar")
				$type="{$base[$i-2]}.{$base[$i-1]}";
			else
				$type = $base[$i-1];
		}

		$pfn = str_replace(" ", "_", $package);
		$archive = "{$pfn}_{$version[0]}.{$version[1]}.{$version[2]}{$stage}";
		$fn = "{$ud}/{$archive}";
		if($type != null)
			$fn .= ".".$type;


		if(!move_uploaded_file($file['tmp_name'], $fn))
			return null;

		return "{$archive}.{$type}";
	}

	function archive_routine_unlink($collection, $package, $archive)
	{
		global $repo_config;
		return unlink($repo_config['docroot']."/repo/{$collection}/{$package}/{$archive}");
	}
?>
