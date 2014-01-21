<?php
	require('../../../php/conn.php');

	$taskId = $_POST['taskId'];
	$taskName = $_POST['taskName'];
	$taskDesc = $_POST['taskDesc'];
	$dataInicio = $_POST['dataInicio'];
	$dataFim = $_POST['dataFim'];
	$userId = $_POST['userId'];

	$horaInicio = $_POST['horaInicio'];
	$minutoInicio = $_POST['minutoInicio'];
	$horaFim = $_POST['horaFim'];
	$minutoFim = $_POST['minutoFim'];

	if($taskId != ''){
		$query = mysql_query("Update tasks Set taskName = '$taskName', `desc` = '$taskDesc', dataInicio = '$dataInicio', dataFim = '$dataFim', horaInicio = '$horaInicio', minutoInicio = '$minutoInicio', horaFim = '$horaFim', minutoFim = '$minutoFim' Where id = '$taskId'");

		$updateTable = mysql_query("Select * From tasks Where userId = $userId");

		$rows = array();

		while($res = mysql_fetch_object($updateTable)){
			$rows[] = $res;
		}

		echo json_encode($rows);
	} else {
		$query = "Insert Into tasks Values ('', '$taskName', '$taskDesc', '$dataInicio', '$dataFim', '$horaInicio', '$minutoInicio', '$horaFim', '$minutoFim', $userId, 0)";

		$sql = mysql_query($query);

		$lastReg = mysql_query("Select max(id) as last From tasks ");
		$resLastReg = mysql_fetch_object($lastReg);

		$updateTable = mysql_query("Select * From tasks Where userId = $userId");

		$rows = array();

		while($res = mysql_fetch_object($updateTable)){
			$rows[] = $res;
		}

		echo json_encode($rows);
	}
	
	

?>