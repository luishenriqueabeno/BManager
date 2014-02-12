<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$userId = $_POST['userId'];
	$firstName = $_POST['firstName'];
	$lastName =  $_POST['lastName'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$signupDate = date('d/m/Y');
	$modulesPermission = $_POST['modulesPermission'];
	$checkmd = $_POST['checkmd'];

	$userIdEdit = $_POST['userIdEdit'];

	$checkMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($checkMaster);

	$rows = count($modulesPermission);

	for($i = 0; $i < $rows; $i++){
		$permissions .= $modulesPermission[$i].',';
	}

	$permissions = substr_replace($permissions, '', -1);

	$getProduct = mysql_query("Select productId, email From users Where id = $userId ");
	$resProduct = mysql_fetch_object($getProduct);

	if($userIdEdit == '' && $resProduct->productId != 1){
		$password1 =  md5($_POST['password1']);

		$query = "Insert Into users Values('', '$firstName', '$lastName', '$email', '$password1', $gender, $resProduct->productId, '$signupDate', '$permissions', '$resProduct->email')";

		$sql = mysql_query($query);

		if($sql){
			echo "Usuário cadastrado com sucesso";
		} else {
			echo "Falha ao cadastrar usuário";
		}
	} elseif($userIdEdit != '') {
		if($checkmd == '1'){
			$password1 = $_POST['password1'];
		} else {
			$password1 = md5($_POST['password1']);
		}

		if($resMaster->userMaster == $email){
			$permissions = 1;
		}

		$query = "Update users Set firstName = '$firstName', lastName = '$lastName', password = '$password1', userType = '$permissions', gender = '$gender' Where id = $userIdEdit";

		$sql = mysql_query($query);

		if($sql){
			echo "Usuário alterado com sucesso";
		} else {
			echo "Falha ao editar usuário";
		}
	} else {
		echo "Para cadastrar mais usuários faça um upgrade do seu plano!";
	}

?>