<?php
	include('lib/packages.php');
	// add and modify tasks
	$tasks['collection'][1] = '../../../';
	$tasks['overview'][1] = '../../';
	$tasks['new-package'][1] = '../../new-package/';
	$tasks['new-version'] = array('New Version', "../new-version/", 'new-version');
	$tasks['back'] = array('Back', "../", 'back');

	$package = collection_routine_get_package($tokens[2], $collection['id'], $db);
	if(!$package) {
		echo "Package details not found";
		return;
	}

	$package = $package[0];

	$smc = package_db_get_scm($package['id'], $db);
?>
<div>
<b>Basic Details</b>
<table>
<tr>
	<td>Package Name:</td>
	<td><input type="text" name="name" value="<?php echo $package['name']; ?>" /></td>
</tr>

<tr>
	<td style="vertical-align: top;"> Description:</td>
	<td><textarea name="desc" rows="7" cols="50"><?php echo $package['desc']; ?></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="Save" style="float: right" /></td>
</tr>
</table>


</div>
