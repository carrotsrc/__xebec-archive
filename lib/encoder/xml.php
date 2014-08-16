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
	function xml_encode_row(array $row, $alias = null, $ignore = null)
	{
		echo "<row>";
		foreach($row as $col => $field) {
			if($ignore && in_array($col, $ignore))
				continue;

			$c = $col;
			if(isset($alias[$col]))
				$c = $alias[$col];
			
			echo "<$c>";
			echo string_prepare_xml($field);
			echo "</$c>";
		}
		echo "</row>";
	}

	function encode_section($section, array $data, $ignore = null, $alias = null)
	{
		echo "<$section>";
		foreach($data as $row)
			echo xml_encode_row($row, $alias, $ignore);
		echo "</$section>";

	}

	function xml_doc()
	{
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><request>";
	}

	function xml_end()
	{
		echo "</request>";
	}
?>
