<?php
	function string_prepare_mysql($string)
	{
		$string = str_replace("\"", "\\\"", $string);
		return $string;
	}

	function string_prepare_xml($string)
	{
		$string = str_replace("<", "&lt;", $string);
		$string = str_replace(">", "&gt;", $string);
		$string = str_replace("&", "&amp;", $string);
		$string = str_replace("'", "&apos;", $string);
		$string = str_replace("\"", "&quot;", $string);

		return $string;
	}
?>
