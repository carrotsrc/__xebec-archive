<?php
	function access_get_value($type, $uid, $ref, $db)
	{
		$sql = "SELECT `value` FROM `access` JOIN `access_types` ON `access_types`.`id` = `access`.`type` ";
		$sql .= "WHERE `access_types`.`name`='$type' AND `access`.`user`='$uid'";
		if($ref)
			$sql .= " AND `access`.`reference`='$ref'";

		if(!($r = db_query($sql, $db)))
			return null;

		return $r[0];
	}

	function access_is_system_admin($uid, $db)
	{
		$value = access_get_value('system', $uid, null, $db);
		if(($value&1))
			return true;

		return false;
	}
?>
