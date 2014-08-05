<?php
include('lib/collections.php');
function init_location($db, $tokens, &$title)
{
	$title = "Collections - Home";
	if(sizeof($tokens) > 0) {
		$title = "Collections - ".$tokens[0];
		if(isset($tokens[1]) && $tokens[1] == "manage")
			$title .= ":manage";
		else
		if(isset($tokens[1]))
			$title .= "/".$tokens[1];
	}
}

function display_location($db, $tokens)
{
	$collection = null;
	$manage = false;

	if(sizeof($tokens) > 0)
		$collection = $tokens[0];

	if(isset($tokens[1]) && $tokens[1] == "manage")
		$manage = true;

	if($collection) {
		if($manage)
			include('system/collections/manage.php');
		else
			include('system/collections/view.php');
	}
	else
		include('system/collections/home.php');
}
?>
