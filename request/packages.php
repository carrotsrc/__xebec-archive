<?php
	$trail['collection'] = $collection['collection'];
	if(!isset($tokens[1])) {
		$packages = collection_routine_get_packages($collection['id'], $db);
		encode_section("packages", $packages);
	} else {
		$package = collection_routine_get_package($tokens[1], $collection['id'], $db);
		if($package) {
			include('request/package.php');
		} else
			echo "<error>Package does not exist</error>";
	
	}
?>
