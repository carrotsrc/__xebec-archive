<?php
	include('../system/init.php');
	include('../lib/users.php');
	include('general.php');
	init_session();

	if(user_session_get_id() == null) {
		header("Location: ../login.php?redir=".$_SERVER['REQUEST_URI']);
		exit;
	}
	$db = init_database();

	$title = "Home";


	$manager = null;
	$loaded = false;
	if(isset($_GET['manager']))
		$manager = "/".$_GET['manager'];

	
	$repo_config['manroot'] = dirname(__file__)."$manager";

	if($manager != null) {
		include($repo_config['manroot'].'/lib.php');
		$loaded = true;
	}
	if($loaded)
		init_manager($db, $title);

?>

<html>
<head>
<title>vegPatch Module Repository - Management Interface - <?php echo $title; ?></title>
<link href="../lib/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
	if(!$loaded)
		die("Nothing selected");

		echo display_manager($db);
?>
</body>
</html>
