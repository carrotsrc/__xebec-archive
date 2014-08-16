<?php
/*
* Copyright 2014, Zunautica Initiatives Ltd.
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/
	$error = false;
	$msg = null;
	include('lib/packages.php');
	if(isset($_POST['desc'])) {
		include('lib/strings.php');
		$package = package_db_get_details($tokens[2], $db);
		$valid = true;

		if(!package_db_modify_details($package['id'], $package['name'], string_prepare_mysql($_POST['desc']), $db)) {
			$error = true;
			$msg = "Error modifying description";
		} else
			$msg = "Modified description";
	
	}
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
<form method="post">

<table>
<tr>
	<td>Package Name:</td>
	<td><?php echo $package['name']; ?></td>
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
</form>
</div>
<?php
if($error)
	echo "<div class=\"color-error\">";
else
	echo "<div class=\"color-success\">";
	echo $msg;
	echo "</div>";

?>
