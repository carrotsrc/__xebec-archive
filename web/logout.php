<?php
	include('../system/init.php');
	include('../lib/users.php');
	init_session();
	user_session_set_id(null);
	header('Location: ../index.php');
?>
