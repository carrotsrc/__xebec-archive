<form method="post" action="">
	<table>
		<tr><td>username:</td><td><input type="text" name="username" /></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
		<tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
	<table>
	<input type="hidden" name="action" value="add" />
	<input type="submit" value="Add user" />
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
		echo "Added user successfully";
		echo "</div>";
	}
?>
