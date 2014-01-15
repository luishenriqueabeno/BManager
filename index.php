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
		<div id="addUserForm" title="Inscreva-se">
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
		<a href = "#" id = "addUserModal"> Inscreva-se </a>
	</body>
</html>