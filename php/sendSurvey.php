<?php
	require("conn.php");

	//Recebe dados do formulário
	$userId = $_POST['userId'];
	$userSurvey = $_POST['userSurvey'];
	$userReport = $_POST['userReport'];

	//Pega data atual
	$date = date("Y-m-d");

	//Insere enquete
	$insertSurvey = mysql_query("
		Insert Into 
			usersurvey
		Values (
			''
			,". $userId ."
			,'". $userSurvey . "'
			,'". $userReport . "'
			,'". $date . "'
		)
	");

	//Atribui mensagem de retorno
	if($insertSurvey){
		$msg = "Obrigado por ter enviado sua opinião.";
	} else {
		$msg = "Falha ao enviar mensagem.";
	}

	//Envia mensagem de retorno
	echo $msg;

?>