<?php
session_start();
ob_start();

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
include 'head.php';

if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'uporabnikID', 'uporabnisko_ime', 'geslo', 'email', 'ime', 'priimek');
}

$errors = array();

?>
