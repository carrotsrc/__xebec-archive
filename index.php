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
	include('system/init.php');
	$db = init_database();
	init_session();
	$tokens = explode('?', $_SERVER['REQUEST_URI']);
	$tokens = explode('/', $tokens[0]);
	if($tokens[1] == "" || $tokens[1] == "index.php")
		$tokens[1] = "home";

	if(end($tokens) == "")
		unset($tokens[sizeof($tokens)-1]);

	if($tokens[1] == 'api') {
		$tokens = array_slice($tokens, 2);
		include('request/handle.php');
		exit;
	}

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
<div id="content-container">
<div id="content-body" class="system-location">
<?php
	display_location($db, array_slice($tokens, 2));
?>
</div>

<div id="content-footer">
<div style="float: right; margin-right: 10px;">Xebec Repo</span>
</div>

</div>

</body>
</html>
