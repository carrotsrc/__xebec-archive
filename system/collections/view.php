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

	if(!isset($tokens[1]))
		$tokens[1] = null;

	if(!isset($tokens[2]))
		$tokens[2] = null;

	if(!isset($tokens[3]))
		$tokens[3] = null;

	$tasks = array(
		'collection' => array('Home', '../', 'collection'),
		'overview' => array('Overview', '../', null)
		);
	if($access)
		$tasks['manage'] = array('Manage','manage/','manage');
	if(!$uid)
		$tasks['login'] = array('Login', '/web/login.php', 'login');
	else
		$tasks['logout'] = array('Logout', '/web/logout.php', 'logout');

	ob_start();
	switch($tokens[1]) {
	case null:
		include('system/collections/browse/home.php');
		break;

	default:
		include('system/collections/browse/view_pkg.php');
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
		if($tokens[1] == $t[2])
			echo "{$t[0]}";
		else
			echo "<a href=\"{$t[1]}\">{$t[0]}</a>";
		echo "</div>";
	}
?>
</div>

<div class="browse-area vtoolbar-offset">
<?php
	echo $html;
?>
</div>
