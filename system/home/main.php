<?php
include('lib/collections.php');
function init_location($db, $tokens, &$title)
{
	$title = "Home";
}

function display_location($db, $tokens)
{
	include('system/home/home.php');
}
?>
