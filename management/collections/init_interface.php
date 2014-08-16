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

		if(!collection_routine_add_directory($_POST['collection'])) {
			set_action_result(0, "An error occured when creating the directory");
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
