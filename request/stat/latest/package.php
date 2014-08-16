<?php
	include('lib/packages.php');
	$collection = collection_db_get_details($collection, $db);
	$collection = $collection[0];
	$package = collection_routine_get_package($tokens[0], $collection['id'], $db);
	$versions = package_db_get_versions($package[0]['id'], $db);

	if(!$versions)
		echo "<error>No versions</error>";
	else
		encode_section('versions', $versions, array('id', 'created'));

?>
