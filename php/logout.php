<?php
	require("php/conf.php");

	session_start();
	session_destroy();

	//Redireciona para a página incial do website
	header('location: '. $baseUrl);
?>	