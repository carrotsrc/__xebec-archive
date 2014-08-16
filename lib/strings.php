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
