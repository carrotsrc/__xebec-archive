<?php
	function interface_add_collection($db)
	{
		if($_POST['collection'] == "") {
			set_action_result(0, "Some fields were not complete");
			return;
		}

		if(!collection_db_add($_POST['collection'], $db)) {
			set_action_result(0, "An error occured when adding the collection");
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
			interface_add_collection($db);
		break;
		}
	}
?>
