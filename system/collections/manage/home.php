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
	$action = null;

	if(isset($_GET['action']))
		$action = $_GET['action'];
	
	if($action == "remove") {
		if(isset($_GET['package'])) {
			collection_routine_remove_package($_GET['package'], $collection, $db);
		}
	}
?>
<h2 style="margin-top: 0px;"><?php echo $tokens[0]; ?></h2>
<?php
	$packages = collection_routine_get_packages($collection['id'], $db);
	if(!$packages) {
		echo "No packages in collection";
		return;
	}

?>
<table>
<tr>
	<th>Package</th>
	<th>Description</th>
</tr>
<?php
	foreach($packages as $p) {
		echo "<tr>";
		echo "<td>";
		echo "<a href=\"{$p['name']}/\">";
		echo $p['name'];
		echo "</a>";
		echo "</td>";
		echo "<td>";
		echo $p['desc'];
		echo "</td>";
		echo "<td>";
		echo "<a href=\"?action=remove&package={$p['id']}\" class=\"acritical\">Remove</a>";
		echo "</td>";
		echo "</tr>";

	}
?>
</table>
