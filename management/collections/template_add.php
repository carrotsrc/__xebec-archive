<form action="" method="post">
	<input type="text" name="collection" /></br >
	<input type="hidden" name="action" value="add" />
	<input type="submit" value="Add Collection" />
</form>
<?php
	$result = get_action_result();
	if($result === 0) {
		echo "<div class=\"color-error\">";
		echo get_action_msg();
		echo "</div>";
	}
	else
	if($result > 0) {
		echo "<div class=\"color-success\">";
		echo "Added collection successfully";
		echo "</div>";
	}
?>
