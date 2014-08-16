<?php
	include('lib/packages.php');
	$package = package_db_get_details($tokens[1], $db);
	$versions = package_db_get_versions($package['id'], $db, true);
	$scm = package_db_get_scm($package['id'], $db, true);

	if(isset($tasks['manage']))
		$tasks['manage'][1] = "../manage/{$package['name']}/";
?>
<h2 style="margin-top: 0px;"><a href="../"><?php echo $collection['collection']; ?></a> / <?php echo $package['name']; ?></h2>
<div>
<?php
	echo $package['desc'];
?>
</div>

<div style="display: inline-block; vertical-align: top; min-width: 30%;" class="cat-container">
<strong>Versions</strong>

<?php
	if($versions) {
		echo "<table class=\"version-table vspacer-small\">";
		foreach($versions as $k => $v) {

			if($k == 0)
				echo "<tr class=\"top\">";
			else
			if($v['deprecated'])
				echo "<tr class=\"deprecated\">";
			else
				echo "<tr>";

			

			echo "<td>";
				echo "{$v['major']}.";
				echo "{$v['minor']}.";
				echo "{$v['maintenance']}";
				echo "{$v['stage']}";
			echo "</td>";
			if($v['archive'])
				echo "<td><a href=\"/repo/{$collection['collection']}/{$package['name']}/{$v['archive']}\">Archive</a></td>";
			else
			echo "<td class=\"color-inactive\">Archive</td>";

			if($v['deprecated'])
				echo "<td>D</td>";
			else
				echo "<td>A</td>";

			echo "<td>{$v['created']}</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else
		echo "<br />No versions found for this package";

?>
</div>

<div style="display: inline-block; vertical-align: top;">
<section class="cat-container">
<strong>Updated</strong>
<div class="vspacer-small"><time datetime="<?php echo $package['updated'] ?>"><?php echo $package['updated'] ?></time></div>
</section>

<section class="cat-container">
<strong>Repositories</strong>
<?php
	if($scm) {
		foreach($scm as $r) {
			echo "<div class=\"vspacer-small\"><a href=\"{$r['url']}\" target=\"_BLANK\">{$r['url']}</a></div>";
		}
	} else
		echo "<div class=\"vspacer-small\">No SCM repositories</div>";
?>
</section>

</div>
