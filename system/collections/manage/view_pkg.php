<?php
	include('lib/packages.php');
	// add and modify tasks
	$tasks['overview'][1] = '../';
	$tasks['new-package'][1] = '../new-package/';
	$tasks['new-version'] = array('New Version', "new-version/", 'new-version');

	$package = collection_routine_get_package($tokens[2], $collection['id'], $db);
	if(!$package) {
		echo "Package details not found";
		return;
	}

	$package = $package[0];

	$versions = package_db_get_versions($package['id'], $db, true);
?>
<div>
<h2 style="margin-top: 0px;"><?php echo $package['name']; ?></h2>
<?php echo $package['desc']; ?>
<div class="version-list">
<table>
<?php
	if($versions) {
		foreach($versions as $v) {
			echo "<tr>";
			echo "<td>{$v['major']}.{$v['minor']}.{$v['maintenance']}{$v['stage']}</td>";
			echo "<td>";
			if($v['archive'] == null)
				echo "No archive";
			else
				echo $v['archive'];
			echo "</td>";
			echo "</tr>";
		}
	} else {
		echo "No versions of this package exist";
	}
?>
</table>
</div>
</div>
