$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/
	$( "#addUserForm" ).hide();
	$( "#loginForm" ).hide();
	$('#txtPassword2').attr('disabled', true);
	var field1 = $('#txtPassword1');
	var field2 = $('#txtPassword2');
	var emailField = $('#txtEmail');
	var firstNameField = $('#txtFirstName');
	var lastNameField = $('#txtLastName');
	var userNameField = $('#txtUsername');
	var passwordField = $('#txtPassword');
	var erroMsgUpdate = true;


	/***************************
	* Inicio das funções 
	****************************/

	//Abre modal para o usuário se inscrever
	$('#addUserModal').click(function(){
		//Exibe modal
		$( "#addUserForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Abre modal para o usuário logar
	$('#loginUserModal').click(function(){
		//Exibe modal
		$( "#loginForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adiciona usuário
	$('#btnAddUser').click(function(){
		//var needsUpdate = true;
		var firstName = $('#txtFirstName').val();
		var lastName = $('#txtLastName').val();
		var email = $('#txtEmail').val();
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();
		var gender = $('#gender').val();
		var product = $('#product').val();
	
		if(field1.hasClass('redBorder') || field2.hasClass('redBorder') || emailField.hasClass('redBorder') || firstNameField.hasClass('redBorder') || lastNameField.hasClass('redBorder')){
			if (erroMsgUpdate) {
				$('#formMessage').append('Corrija os campos destacados');
				erroMsgUpdate = false;
			}
		} else {
			$.ajax({
				type: 'POST',
				url: 'php/addUser.php',
				data:{
					firstName: firstName,
					lastName: lastName,
					email: email,
					password1: password1,
					product: product,
					gender: gender
				},
				success: function(data){
					$( "#addUserForm" ).dialog( "destroy" );
				}
			});
		}
	});

	//Verifica senhas e altera estilo
	$('#txtPassword1').keyup(function(){
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();

		if(password1.length < 6 || password1 == ''){
			field1.addClass('redBorder');
		} else {
			field1.removeClass('redBorder').addClass('greenBorder');
			$('#txtPassword2').attr('disabled', false);
		}
	});
	$('#txtPassword2').keyup(function(){
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();

		if(password2.length < 6){
			field2.addClass('redBorder');
		} else if(password1 != password2) {
			field1.addClass('redBorder');
			field2.addClass('redBorder');
		} else {
			field1.removeClass('redBorder').addClass('greenBorder');
			field2.removeClass('redBorder').addClass('greenBorder');
		}
	});

	//Verifica email e altera estilo
	$('#txtEmail').keyup(function(){
		var email = $(this).val();

	    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

	    if(pattern.test(email)){         
			emailField.removeClass('redBorder').addClass('greenBorder');
	    }else{   
			emailField.addClass('redBorder');
	    }

	});

	//Verifica nome e altera estilo
	$('#txtFirstName').focusout(function(){
		var firstName = $('#txtFirstName').val();

		if(firstName == ''){
			firstNameField.addClass('redBorder');
		} else {
			firstNameField.removeClass('redBorder').addClass('greenBorder');
		} 
	});

	//Verifica sobrenome e altera estilo
	$('#txtLastName').focusout(function(){
		var lastName = $('#txtLastName').val();

		if(lastName == ''){
			lastNameField.addClass('redBorder');
		} else {
			lastNameField.removeClass('redBorder').addClass('greenBorder');
		} 

	});

	//Autentica usuário
	$('#btnLogin').click(function(){
		var username = $('#txtUsername').val();
		var password = $('#txtPassword').val();

		$.ajax({
			url: 'php/logon.php',
			type: 'POST',
			data:{
				username: username,
				password: password
			},
			success: function(data){
				$( "#loginForm" ).dialog( "destroy" );
				if(data == 1){
					//Redireciona para a página principal do sistema
					window.location.href = "home.php";	
				} else {
					alert("Usuário e/ou senha incorreto.");
				}
			}
		})
	});

	//Botão cancelar do formulário para inscrição
	$('#btnCancelUserForm').on('click', function(){
		$( "#addUserForm" ).dialog( "destroy" );
	});

	//Botão cancelar do formulário para logar
	$('#btnCancelLoginForm').on('click', function(){
		$( "#loginForm" ).dialog( "destroy" );
	});
})