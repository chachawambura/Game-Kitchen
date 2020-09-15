<?php
	require_once "../includes/configs.php";

	$responce = Mpesa::b2cCallback();

	print_r($responce);
?> 