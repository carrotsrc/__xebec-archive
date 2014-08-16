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
