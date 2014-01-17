<?php session_start(); ?>
<!doctype html>
<html lang = "pt">
	<head>
		<title> Daily Helper </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="resources/css/style.css">
		<link rel="stylesheet" href="lib/jquery-ui-1.10.3/themes/base/jquery-ui.css">

		<!-- Scripts -->
		<script src = "lib/jquery-1.10.2/jquery-1.10.2.dev.js" type = "text/javascript"></script>
		<script src="resources/js/index.js"></script>
		<script src="lib/jquery-ui-1.10.3/ui/jquery-ui.js"></script>

	</head>
	<body>
		<!--#########################-->
		<!--######## Modals #########-->
		<!--#########################-->

		<!-- Add user modal -->
		<div id="addUserForm" title="Inscreva-se">
			<div id = "formMessage"> </div>
			<form method = "post" id = "formAddTask">
				<label for = "firstName"> Nome </label>
				<input id = "txtFirstName" type = "text" name = "txtFirstName" >

				<label for = "lastName"> Sobrenome </label>
				<input id = "txtLastName" type = "text" name = "txtLastName" >

				<label for = "email"> Email </label>
				<input id = "txtEmail" type = "text" name = "txtEmail" >

				<label for = "pass1"> Senha </label>
				<input id = "txtPassword1" type = "password" name = "txtPassword1" >

				<label for = "pass2"> Repita a senha </label>
				<input id = "txtPassword2" type = "password" name = "txtPassword2" >

				<label for = "gender"> Sexo </label>
				<select id = "gender">
					<option value = '1'> Masculino </option>
					<option value = '2'> Feminino </option>
				</select>

				<label for = "product"> Produto </label>
				<select id = "product">
					<option value = '1'> Free </option>
				</select>

				<div class = "formAddUserSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddUser" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cadastrar</span> </button>
						<button id = "btnCancelUserForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- Login modal -->
		<div id="loginForm" title="Login">
			<form method = "post" id = "formLogin">
				<label for = "username"> Email </label>
				<input id = "txtUsername" type = "text" name = "txtUsername" >

				<label for = "password"> Senha </label>
				<input id = "txtPassword" type = "password" name = "txtPassword" >

				<div class = "formLoginSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnLogin" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">OK</span> </button>
						<button id = "btnCancelLoginForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!--#########################-->
		<!--######## Page ###########-->
		<!--#########################-->
		<a href = "#" id = "addUserModal"> Inscreva-se </a>
		<?php if($_SESSION['login'] == 1){ ?>
					<a href = "home.php" id = "systemRedirect"> Acessar sistema </a>
					<a href = "php/logout.php" name = "logout"> Logout </a>
		<?php } else { ?>
					<a href = "#" id = "loginUserModal"> Login </a>
		<?php } ?>

	</body>
</html>