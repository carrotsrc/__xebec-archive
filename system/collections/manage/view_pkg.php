<?php
	$result = collection_routine_get_package($tokens[2], $collection['id'], $db);
	if(!$result) {
		echo "Package details not found";
		return;
	}

	$result = $result[0];
?>
<div>
<h2 style="margin-top: 0px;"><?php echo $result['name']; ?></h2>
<?php echo $result['desc']; ?>
</div>
