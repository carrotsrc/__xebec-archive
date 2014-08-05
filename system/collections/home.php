<?php
	$collections = collection_db_get_all($db);
	if(!$collections) {
		echo "No collections";
		return;
	}

	foreach($collections as $c)
		echo "<a href=\"collections/{$c['collection']}\">{$c['collection']}</a>";
?>
