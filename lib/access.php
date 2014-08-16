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
