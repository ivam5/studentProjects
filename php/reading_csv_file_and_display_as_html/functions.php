<?php

function readCSV($filename)
{
	$file_array = file($filename);

	if(is_array($file_array)) {

		$header_row_array = array();

		foreach($file_array as $key => $line)
		{
			$line = trim($line, "\n");
			$line = trim($line, "\r");

			$line_array = explode(";", $line);

			if($key == 0)
			{
				$header_row_array = $line_array;
				unset($file_array[$key]);
			}
			else
			{
				$file_array[$key] = array_combine($header_row_array,$line_array);
			}
		}
	}
	return $file_array;
}

?>
