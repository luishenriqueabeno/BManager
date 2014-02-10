<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];

	$getMaster = mysql_query ("Select userMaster from users Where id = '$userId'");

	$resMaster = mysql_fetch_object($getMaster);

	$getUsersDown = mysql_query("Select * From users Where userMaster = '$resMaster->userMaster'");

	$rows = array();

	while($res = mysql_fetch_object($getUsersDown)){
		$userType = explode(',', $res->userType);
		
		$res->userType = '';

		for($i = 0; $i < count($userType);$i++){
			if($userType[$i] == 1){
				$res->userType .= 'Master ';
			} elseif($userType[$i] == 2){
				$res->userType .= 'Fluxo de caixa | ';
			} elseif($userType[$i] == 3){
				$res->userType .= 'Estoque | ';
			}
		}

		$rows[] = $res;
	}

	echo json_encode($rows);

?>