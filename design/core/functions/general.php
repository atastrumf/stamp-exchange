<?php 
	
	function spucaj_array(&$item) {
		$item = mysql_real_escape_string($item);
	}

	function spucaj($data) {

		return mysql_real_escape_string($data);
	}

	function output_errors($errors) {
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}

?>
