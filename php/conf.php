<?php
	//Pega url base
	$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/';

	//Verifica se é ambiente de produção ou desenvolvimento
	if($baseUrl == 'http://localhost/'){
		$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/BManager/';
	} else {
		$baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/projetos/BManager/';
	}
?>