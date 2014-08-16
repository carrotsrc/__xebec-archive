<?php
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates($limit, $collection, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	} else {
		include('request/stat/latest/package.php');
	}
?>
