<?php
	include('lib/packages.php');
	$trial['package'] = $package[0]['name'];
	encode_section("package", $package);

	$versions = package_db_get_versions($package[0]['id'], $db, true);
	if($versions)
		encode_section("versions", $versions);
?>
