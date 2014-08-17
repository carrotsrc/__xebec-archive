 <?php
	include('system/init.php');
	include('lib/users.php');
	$db = init_database();

 	$error = false;
	$msg = null;
	if(isset($_POST['username'])
	&& isset($_POST['password'])
	&& isset($_POST['email'])) {
		if(!($uid = user_routine_add($_POST['username'], $_POST['email'], $_POST['password'], $db))) {
			$error = true;
		} else {
			db_query("INSERT INTO `access_types` (`name`) VALUES ('system')", $db);
			$atype = db_last_id($db);
			db_query("INSERT INTO `access` (`type`,`user`,`value`) VALUES ('$atype', '$uid', '1')", $db);
		}

	}
 ?>

<form method="post" action="">
	<table>
		<tr><td>username:</td><td><input type="text" name="username" /></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
		<tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
	<table>
	<input type="hidden" name="action" value="add" />
	<input type="submit" value="Add admin" />
</form>
