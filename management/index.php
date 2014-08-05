<?php
	include('../system/init.php');
	include('../lib/users.php');
	$db = init_database();
	init_session();

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
		init_manager($db);

?>

<html>
<head>
<title>vegPatch Module Repository - Management Interface</title>
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
