<?php
	include('lib/packages.php');
	$tasks['overview'][1] = "../../";
	$tasks['new-package'][1] = "../../new-package/";
	$tasks['back'] = array("Back", "../", "back");
	$error = false;

	if(isset($_POST['action']) && $_POST['action'] == "new") {
		$version = explode(".", $_POST['version']);
		$s = sizeof($version)-1;
		$i = 0;
		$stage = "";
		while(isset($version[$s][$i])) {
			if(!is_numeric($version[$s][$i])) {
				$n = substr($version[$s], 0, $i);
				$stage = substr($version[$s], $i);
				$version[$s] = $n;
			}
			$i++;
		}

		if(!isset($version[1]))
			$version[1] = "0";

		if(!isset($version[2]))
			$version[2] = "0";

		if(!package_routine_add_version($version, $stage, $tokens[2], null, $db)) {
			$error = true;
			$msg = 'Failed to add version';
		} else
			$msg = 'Created new verison';

	}
?>
Create a new version of <?php echo $tokens[2]; ?>

<form method="post">
	<table>
	<tr>
		<td>Version Number</td>
		<td><input type="text" name="version" style="width: 100%;" /></td>
	</tr>
	<tr>
		<td>Archive</td>
		<td><input type="file" name="archive" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="create" style="float: right;" /></td>
	</tr>
	</table>
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	<input type="hidden" name="action" value="new" />
</form>
<?php
if($error)
	echo "<div class=\"color-error\">";
else
	echo "<div class=\"color-success\">";
	echo $msg;
	echo "</div>";

?>
