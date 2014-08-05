<?php

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
