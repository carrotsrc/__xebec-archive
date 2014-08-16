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

	function get_interface()
	{
		if(isset($_GET['interface']))
			return $_GET['interface'];

		return 'view';
	}

	function init_manager($db, &$title)
	{
		global $repo_config;
		$interface = get_interface();
		include($repo_config['manroot']."/init_interface.php");
		$title = "Users";
		init_interface($db);
	}

	function display_manager($db)
	{
		global $repo_config;
		$interface = get_interface();
		ob_start();
		switch($interface) {
		case 'view':
			include($repo_config['manroot']."/template_view.php");
		break;
		case 'add':
			include($repo_config['manroot']."/template_add.php");
		break;
		default:
			echo "No interface found";
			break;
		}

		$mu = ob_get_contents();
		ob_clean();
		return $mu;
	}
?>
