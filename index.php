<?php
	include('system/init.php');
	$db = init_database();
	init_session();
	$tokens = explode('/', $_SERVER['REQUEST_URI']);
	if($tokens[1] == "" || $tokens[1] == "index.php")
		$tokens[1] = "home";
	$loaded = false;

	if(!file_exists("system/".$tokens[1]."/main.php"))
		$tokens = array('','errors','404');

	include("system/".$tokens[1]."/main.php");
	$title = "Home";
	init_location($db, array_slice($tokens, 2), $title);
?>

<html>
<head>
<title>vegPatch Module Repository - <?php echo $title; ?></title>
</head>
<body>
<?php
	display_location($db, array_slice($tokens, 2));
?>
</body>
</html>
