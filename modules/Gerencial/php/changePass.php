<?php
	require('../../../php/conn.php');

	//Recebe dados do formulário
	$userId = $_POST['userId'];
	$actualPass = md5($_POST['actualPass']);
	$newPass = md5($_POST['newPass']);

	//Verifica se a senha atual é realmente a mesma que o usuário esta utilizando
	//O hash deve ser o mesmo
	$sqlActualPass = mysql_query("Select password From `users` Where id = ". $userId ." ");
	$resActualPass = mysql_fetch_object($sqlActualPass);

	//Verifica se a senha atual informada pelo usuário é realmente a que esta cadastrada no banco
	if( $resActualPass->password == $actualPass){
		//Altera senha
		$changePass = mysql_query("Update `users` Set password = '". $newPass . "' Where id = ". $userId ." ");

		//Retorna true para tratar mensagem no front
		echo true;
	} else {
		//As senha atual esta incorreta, retorna false para tratar no front
		echo false;
	}
?>