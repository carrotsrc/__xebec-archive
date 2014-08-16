<?php
	$limit = 10;

	/* set the limit of the number of packages to pull */
	if(isset($_GET['limit']))
		$limit = $_GET['limit'];

	include('lib/collections.php');
	if(!isset($tokens[0])) {
		$packages = collection_routine_package_updates($limit, null, $db);
		if(!$packages)
			echo "<error>No packages</error>";
		else
			encode_section("packages", $packages);
	} else {
		$collection = $tokens[0];
		$tokens = array_slice($tokens, 1);
		include('request/stat/latest/collection.php');
	}
?>
