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
	include('lib/users.php');
	include('lib/access.php');
	$uid = user_session_get_id();
	$access = false;
	if(access_is_system_admin($uid, $db))
		$access = true;

	$collection = collection_db_get_details($tokens[0], $db);
	$collection = $collection[0];

	if(($value = access_get_value("collection", $uid, $collection['id'], $db)))
		if(($value&1))
			$access = true;

	if(!$access) {
		echo "Access denied!";
		return;
	}


	if(!isset($tokens[2]))
		$tokens[2] = null;
	else {
		if(isset($tokens[2][0]) && $tokens[2][0] == '?')
			$tokens[2] = null;
	}
	
	if(!isset($tokens[3]))
		$tokens[3] = null;

	$tasks = array(
		'collection' => array('Home', "../", 'collection'),
		'overview' => array('Overview', 'manage/', null),
		'new-package' => array('New Package', 'new-package/', 'new-package')
		);

	ob_start();
	switch($tokens[2]) {
		case null:
			include("system/collections/manage/home.php");
			break;

		case 'new-package':
			include("system/collections/manage/new_pkg.php");
			break;

		default:
			if($tokens[3] == 'new-version') {
				include('system/collections/manage/new_version.php');
				break;
			} else
			if($tokens[3] == 'modify') {
				include('system/collections/manage/modify_pkg.php');
				break;
			} else
			include("system/collections/manage/view_pkg.php");
			break;
	}
	$html = ob_get_contents();
	ob_clean();

?>
<div class="vtoolbar">
<b>Tasks</b><br />
<?php
	foreach($tasks as $t) {
		echo "<div class=\"item\">";
		if($tokens[2] == $t[2])
			echo "{$t[0]}";
		else
			echo "<a href=\"{$t[1]}\">{$t[0]}</a>";
		echo "</div>";
	}
?>
</div>
<div class="manager-area vtoolbar-offset">
<?php
	echo $html;
?>
</div>
