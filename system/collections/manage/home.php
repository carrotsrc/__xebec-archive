<?php
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
