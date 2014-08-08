<?php
	function xml_encode_row(array $row, $alias = null)
	{
		echo "<row>";
		foreach($row as $col => $field) {
			echo "<col id=\"";
			if(isset($alias[$col]))
				echo $alias[$col];
			else
				echo $col;
			
			echo "\">";
			echo string_prepare_xml($field);
			echo "</col>";
		}
		echo "</row>";
	}

	function encode_section($section, array $data, $alias = null)
	{
		echo "<$section>";
		foreach($data as $row)
			echo xml_encode_row($row, $alias);
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
