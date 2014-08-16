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
	function get_action_result()
	{
		if(!isset($GLOBALS['action_result']))
			return null;

		return $GLOBALS['action_result'];
	}

	function get_action_msg()
	{
		if(!isset($GLOBALS['action_msg']))
			return null;

		return $GLOBALS['action_msg'];
	}

	function set_action_result($result, $msg)
	{
		$GLOBALS['action_result'] = $result;
		$GLOBALS['action_msg'] = $msg;
	}
?>
