<?php
	include('lib/collections.php');
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates(null, null, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	}
?>
