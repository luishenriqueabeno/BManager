<?php
	require('../../../php/conn.php');

	$bankName = $_POST['bankName'];
	$txtAgNumber = $_POST['txtAgNumber'];
	$txtAccNumber = $_POST['txtAccNumber'];
	$txtManagerName = $_POST['txtManagerName'];
	$txtManagerTel = $_POST['txtManagerTel'];
	$txtManagerEmail = $_POST['txtManagerEmail'];
	$userId = $_POST['userId'];
	$hidenId = $_POST['hidenId'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Caso haja um id faz update
	if($hidenId != ''){
		$update = mysql_query("
			Update contasbancarias
			Set
				banco = '". $bankName ."'
				,agencia = '". $txtAgNumber ."'
				,conta = '". $txtAccNumber ."'
				,nomeGerente = '". $txtManagerName ."'
				,telGerente = '". $txtManagerTel ."'
				,emailGerente = '". $txtManagerEmail ."'
			Where
				id = ". $hidenId ."
		");


		if($update){
			$msg = "Conta bancaria alterada com sucesso";
		} else {
			$msg = "Falha ao alterar conta bancária";
		}

	} else {
		//Não existe id, faz insert
		$insert = mysql_query("
			Insert Into 
				contasbancarias
			Values (
				''
				,'". $bankName ."'
				,'". $txtAgNumber ."'
				,'". $txtAccNumber ."'
				,'". $txtManagerName ."'
				,'". $txtManagerTel ."'
				,'". $txtManagerEmail ."'
				,'". $userId ."'
				,'". $resMaster->userMaster ."'
			)
		");

		if($insert){
			$msg = "Conta bancaria adicionada com sucesso";
		} else {
			$msg = "Falha ao adicionar conta bancária";
		}

	}

	
	echo $msg;
?>