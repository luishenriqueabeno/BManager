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

				<a href = '#' id = 'forgotPass' class = 'forgotPass'> Esqueci minha senha! </a>

				<div class = "formLoginSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnLogin" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">OK</span> </button>
						<button id = "btnCancelLoginForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- Forgot pass modal -->
		<div id="forgotPassForm" title="Recuperar senha">
			<form method = "post" id = "formForgotPass">
				<div id = "passSend"> Uma nova senha foi enviada para seu email </div>
				<div id = "passError"> Não encontramos o e-mail informado em nossa base de dados </div>
				<label for = "username"> Email cadsatrado: </label> <span class = "emailReqForgot"> </span>
				<input id = "txtUsernameRecover" type = "text" name = "txtUsername" >

				<div class = "formForgotpassSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnRecoverPass" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Enviar e-mail</span> </button>
						<button id = "btnCancelForgotpassForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
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
					<br>
					<a href = "php/logout.php" name = "logout"> Logout </a>
		<?php } else { ?>
					<br>
					<a href = "#" id = "loginUserModal"> Login </a>
		<?php } ?>
		<br>
		<br>
		<p> Testes e homologação nos navegadores Internet explorer 9+, google chrome e mozila firefox </p>
	</body>
</html>