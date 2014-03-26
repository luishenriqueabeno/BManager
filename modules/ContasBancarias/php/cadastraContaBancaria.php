<?php
	require('../../../php/conn.php');

	$bankName = $_POST['bankName'];
	$txtAgNumber = $_POST['txtAgNumber'];
	$txtAccNumber = $_POST['txtAccNumber'];
	$txtManagerName = $_POST['txtManagerName'];
	$txtManagerTel = $_POST['txtManagerTel'];
	$txtManagerEmail = $_POST['txtManagerEmail'];
	$userId = $_POST['userId'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

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

	echo $msg;
?>