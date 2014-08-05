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
?>
