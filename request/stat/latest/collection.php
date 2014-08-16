<?php
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates($limit, $collection, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	} else {
		$collection = $tokens[0];
		$tokens = array_slice($tokens, 1);
		include('request/stat/latest/package.php');
	}
?>
