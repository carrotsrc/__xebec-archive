<?php
	function string_prepare_mysql($string)
	{
		$string = str_replace("\"", "\\\"", $string);
		return $string;
	}
?>
