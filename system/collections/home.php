<?php
	$collections = collection_db_get_all($db);
	if(!$collections) {
		echo "No collections";
		return;
	}

	foreach($collections as $c)
		echo "<a href=\"{$c['collection']}/\">{$c['collection']}</a><br />";
?>
