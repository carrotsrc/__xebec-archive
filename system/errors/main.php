<?php
include('lib/collections.php');
function init_location($db, $tokens, &$title)
{
	$title = "Error " . $tokens[0];
}

function display_location($db, $tokens)
{
	include("system/errors/".$tokens[0].".php");
}
?>
