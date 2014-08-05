<?php
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

$tasks = array(
	array('Overview', '../manage', null),
	array('Add Package', 'manage/new-package', 'new-package')
	);

?>

<div class="manager-vtoolbar">
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
<div class="manager-varea vtoolbar-offset">
<?php

	switch($tokens[2]) {
		case null:
			include("system/collections/manage/home.php");
			break;

		case 'new-package':
			include("system/collections/manage/new.php");
			break;

		default:
			include("system/collections/manage/home.php");
			break;
	}
?>
</div>
