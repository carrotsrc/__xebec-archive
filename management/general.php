<?php
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
