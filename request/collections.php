<?php
	include('lib/collections.php');

	if(!isset($tokens[0])) {
		$collections = collection_db_get_all($db);
		encode_section("collections", $collections);
	}
?>
