
<?php 
	error_reporting(E_ERROR | E_PARSE);
	require("../../secure.php"); 
	require("../../php/conn.php"); 
	$userId = $_SESSION['userId'];
?>
<!doctype html>
<html lang = "pt">
	<head>
		<title> Cash Flow </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="modules/Gerencial/resources/css/style.css">

		<!-- Scripts -->
		<script src = "modules/Gerencial/resources/js/gerencial.js" type = "text/javascript"></script>

	</head>
	<body>

		<!-- Dialogs -->
		<div id="addUserForm" title="Adicionar usuário">
			<div id = "formMessage"> </div>
			<div id = "formMessageSuccess"> </div>
			<form method = "post" id = "formAddTask">
				<label for = "firstName"> Nome </label> <span class = "firstNameReq"> </span>
				<input id = "txtFirstName" type = "text" name = "txtFirstName" >

				<label for = "lastName"> Sobrenome </label> <span class = "lastNameReq"> </span>
				<input id = "txtLastName" type = "text" name = "txtLastName" >

				<label for = "email"> Email </label> <span class = "emailReq"> </span>
				<input id = "txtEmail" type = "text" name = "txtEmail" >

				<label for = "pass1"> Senha </label> <span class = "pass1"> </span>
				<input id = "txtPassword1" type = "password" name = "txtPassword1" >

				<label for = "pass2"> Repita a senha </label> <span class = "pass2"> </span>
				<input id = "txtPassword2" type = "password" name = "txtPassword2" >

				<label for = "gender"> Sexo </label>
				<select id = "gender">
					<option value = '1'> Masculino </option>
					<option value = '2'> Feminino </option>
				</select>

				<div class = "formAddUserSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddUser" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cadastrar</span> </button>
						<button id = "btnCancelUserForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- User List -->
		<div id = "usersContainer">
			<div class = "userContainerTitle"> Usuários </div>	
			<div class = "userList">
				<div class="table-responsive">
					<table class = "table" id = "userPanel">
						<tr>
							<td>
								<div class = "bgBtnContainer">
									<div id = "addUser"> </div>
								</div>
								<div class = "bgBtnContainer">
									<div id = "removeUser"> </div> 
								</div>
							</td>
						</tr>
					</table>

					<table class = "table" id = "userList">
						<tr>
							<td> Nome </td>
							<td> Usuário </td>
							<td> Permissões </td>
							<td> Editar </td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>