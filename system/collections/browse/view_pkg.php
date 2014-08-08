<?php
	include('lib/packages.php');
	$package = package_db_get_details($tokens[1], $db);
	$versions = package_db_get_versions($package['id'], $db, true);

	if(isset($tasks['manage']))
		$tasks['manage'][1] = "../manage/{$package['name']}/";
?>
<h2 style="margin-top: 0px;"><a href="../"><?php echo $collection['collection']; ?></a> / <?php echo $package['name']; ?></h2>
<div>
<?php
	echo $package['desc'];
?>
</div>

<div style="display: inline-block; vertical-align: top;">
<strong>Versions</strong>

<?php
	if($versions) {
		echo "<table>";
		echo "</table>";
	}

?>
</div>
