<?php
	include('lib/packages.php');
	encode_section("package", $package, array('id', 'cid', 'pid'));
	$package = $package[0];
	$trial['package'] = $package['name'];

	$versions = package_db_get_versions($package['id'], $db, true);
	if($versions)
		encode_section("versions", $versions, array('id'));
	
	$scm = package_db_get_scm($package['id'], $db);
	if($scm)
		encode_section("scm", $scm, array('id'));
?>
