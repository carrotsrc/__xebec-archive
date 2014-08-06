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
		echo "<a href=\"manage/{$p['name']}\">";
		echo $p['name'];
		echo "</a>";
		echo "</td>";
		echo "<td>";
		echo $p['desc'];
		echo "</td>";
		echo "</tr>";

	}
?>
</table>
