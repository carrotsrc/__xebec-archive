<?php
	function interface_add_user($db)
	{
		if($_POST['username'] == ""
		|| $_POST['password'] == ""
		|| $_POST['email'] == "") {
			set_action_result(0, "Some fields were not complete");
			return;
		}

		if(!user_routine_add($_POST['username'], $_POST['email'], $_POST['password'], $db)) {
			set_action_result(0, "An error occured when adding the user account");
			return;
		}

		set_action_result(1, null);
		return;
	}

	function init_interface($db)
	{
		$action = null;
		if(!isset($_POST['action'])) {
			if(!isset($_GET['action']))
				return;

			$action = $_GET['action'];
		}
		else
			$action = $_POST['action'];

		switch($action) {
		case 'add':
			interface_add_user($db);
		break;
		}
	}

?>
