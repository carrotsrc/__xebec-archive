<?php
	include('system/init.php');
	$db = init_database();
	init_session();
	$tokens = explode('/', $_SERVER['REQUEST_URI']);
	if($tokens[1] == "" || $tokens[1] == "index.php")
		$tokens[1] = "home";

	if(end($tokens) == "")
		unset($tokens[sizeof($tokens)-1]);

	$loaded = false;

	if(!file_exists("system/".$tokens[1]."/main.php"))
		$tokens = array('','errors','404');

	include("system/".$tokens[1]."/main.php");
	$title = "Home";
	init_location($db, array_slice($tokens, 2), $title);
?>
<!DOCTYPE html> 
<html>
<head>
<title><?php echo $repo_config['title']; ?> - <?php echo $title; ?></title>
<link href="/lib/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="system-location">
<?php
	display_location($db, array_slice($tokens, 2));
?>
</div>
</body>
</html>
