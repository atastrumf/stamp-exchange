<?php

	function spucaj_array(&$item) {
		$item = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $item);
	}

	function output_errors($errors) {
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}

?>
