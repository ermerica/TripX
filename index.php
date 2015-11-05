<?php
	require_once('functions.php');
?>

<?php load_template('header'); ?>

<?php
	
	if($_GET['template']) {
		$template = $_GET['template'];
		load_template($template);
	}
	else {
		load_template('home');
	}
?>

<?php load_template('footer'); ?>