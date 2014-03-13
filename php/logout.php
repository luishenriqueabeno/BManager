<?php
	session_start();
	session_destroy();

	//Pega url base
	$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/';

	//Verifica se é ambiente de produção ou desenvolvimento
	if($baseUrl == 'http://localhost/'){
		$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/BManager/';
	} else {
		$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/trabalhos/2014/BManager/';
	}

	//Redireciona para a página incial do website
	header('location: '. $baseUrl);
?>	