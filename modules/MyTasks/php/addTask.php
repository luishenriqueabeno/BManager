<?php
	require('../../../php/conn.php');

	$taskId = $_POST['taskId'];
	$taskName = $_POST['taskName'];
	$taskDesc = $_POST['taskDesc'];
	$dataInicio = $_POST['dataInicio'];
	$dataFim = $_POST['dataFim'];

	$horaInicio = $_POST['horaInicio'];
	$minutoInicio = $_POST['minutoInicio'];
	$horaFim = $_POST['horaFim'];
	$minutoFim = $_POST['minutoFim'];

	if($taskId != ''){
		$query = "Update tasks Set taskName = '$taskName', `desc` = '$taskDesc', dataInicio = '$dataInicio', dataFim = '$dataFim', horaInicio = '$horaInicio', minutoInicio = '$minutoInicio', horaFim = '$horaFim', minutoFim = '$minutoFim' Where id = '$taskId'";
	} else {
		$query = "Insert Into tasks Values ('', '$taskName', '$taskDesc', '$dataInicio', '$dataFim', '$horaInicio', '$minutoInicio', '$horaFim', '$minutoFim')";
	}
	

	//echo $query;

	$sql = mysql_query($query);

?>