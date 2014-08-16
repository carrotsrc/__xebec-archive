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
	include('../system/init.php');
	include('../lib/users.php');
	$db = init_database();
	init_session();
	$msg = null;

	$uid = user_session_get_id();
	if($uid) {
		if(!isset($_GET['redir'])) {
			header('Location: ../');
			exit;
		}

		header("Location: ".$_GET['redir']);
		exit;
	}

	if(isset($_POST['username']) && isset($_POST['password'])) {
		if(!user_routine_check_password($_POST['username'], $_POST['password'], $db)) {
			$msg = "Username or password incorrect";
		} else {
			$redir = "../";
			if(isset($_GET['redir']))
				$redir = $_GET['redir'];

			$r = user_db_get_details($_POST['username'], $db);
			user_session_set_id($r[0]['id']);

			header("Location: {$redir}");
			exit;
		}
	}
?>

<!DOCTYPE html> 
<html>
<head>
<title><?php echo $repo_config['title']; ?> - Login</title>
<link href="lib/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
<form action="" method="post">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="submit" value="Login" />
</form>
<div class="color-error">
<?php echo $msg; ?>
</div>
</body>
</html>
