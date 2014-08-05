<?php
	include('system/init.php');
	include('lib/users.php');
	$db = init_database();
	init_session();
	$msg = null;

	$uid = user_session_get_id();
	if($uid) {
		if(!isset($_GET['redir'])) {
			header('Location: index.php');
			exit;
		}

		header("Location: ".$_GET['redir']);
		exit;
	}

	if(isset($_POST['username']) && isset($_POST['password'])) {
		if(!user_routine_check_password($_POST['username'], $_POST['password'], $db)) {
			$msg = "Username or password incorrect";
		} else {
			$redir = "index.php";
			if(isset($_GET['redir']))
				$redir = $_GET['redir'];

			$r = user_db_get_details($_POST['username'], $db);
			user_session_set_id($r[0]['id']);

			header("Location: {$redir}");
			exit;
		}
	}
?>

<html>
<head>
<title>vegPatch Module Repository - Login</title>
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
