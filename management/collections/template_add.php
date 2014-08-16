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
