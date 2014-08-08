<?php
	$tasks['collection'][1] = "../../";
	$tasks['overview'][1] = "../";
	// run the addition
	$error = false;
	$msg = null;
	if(isset($_POST['action']) && $_POST['action'] == 'new') {
		include('lib/packages.php');
		include('lib/strings.php');
		$_POST['name'] = str_replace(" ", "_", $_POST['name']);
		if(collection_routine_package_exists($_POST['name'], $collection['id'], $db)) {
			$error = true;
			$msg = "Package already exists in collection";
		} else {
			$id = package_db_add($_POST['name'], string_prepare_mysql($_POST['desc']), $db);
			if(!$id) {
				$error = true;
				$msg = "Error creating package";
			} else {
				if(!collection_routine_add_package($id, $collection['id'], $db)) {
					$error = true;
					$msg = "Error adding package to collection";
				} else  {
					collection_routine_add_package_directory($_POST['name'], $collection['collection']);
					$msg = "Successfully added package to collection";
					header( "refresh:1;url=../{$_POST['name']}/" );
				}
			}
		}

	}
?>
New Package
<form method="post" action="">
	<input type="hidden" name="action" value="new" />
	<table>
	<tr>
		<td>Package Name:</td>
		<td><input type="text" name="name" /></td>
	</tr>

	<tr>
		<td style="vertical-align: top;">Description:</td>
		<td><textarea name="desc" rows="7" cols="50"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td> <input type="submit" value="Add Package" style="float: right;"/> </td>
	</tr>
	</table>
</form>
<?php
if($error)
	echo "<div class=\"color-error\">";
else
	echo "<div class=\"color-success\">";
	echo $msg;
	echo "</div>";

?>
