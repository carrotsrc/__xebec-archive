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

?>
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
