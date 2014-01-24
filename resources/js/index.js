$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/
	$( "#addUserForm" ).hide();
	$( "#loginForm" ).hide();
	$('#forgotPassForm').hide();
	$('#txtPassword2').attr('disabled', true);
	var field1 = $('#txtPassword1');
	var field2 = $('#txtPassword2');
	var emailField = $('#txtEmail');
	var firstNameField = $('#txtFirstName');
	var lastNameField = $('#txtLastName');
	var userNameField = $('#txtUsername');
	var passwordField = $('#txtPassword');
	var emailRecoverField = $('#txtUsernameRecover');
	var formSucess = 0;
	var erroMsgUpdate = true;

	var firstNameReq = $('.firstNameReq');
	var lastNameReq = $('.lastNameReq');
	var emailReq = $('.emailReq');
	var emailReqForgot = $('.emailReqForgot');
	var pass1 = $('.pass1');
	var pass2 = $('.pass2');


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
				$('#formMessage').append('Corrija os campos destacados').css('color', 'red');
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
					if(formSucess == 0){
						$('#formMessage').remove();
						$('#formMessageSuccess').append('Usuário cadastrado com sucesso').css('color', 'green');
						$('#formMessageSuccess').append("<a href = '#' id = 'loginLink' class = 'loginLink'>Login </a>");
						formSucess = 1;
						$('#formAddTask')[0].reset();
						field1.removeClass('greenBorder');
						field2.removeClass('greenBorder');
						firstNameField.removeClass('greenBorder');
						lastNameField.removeClass('greenBorder');
						emailField.removeClass('greenBorder');
					}

					//Abre modal de login a partir do formulário de cadastro
					$('#loginLink').on('click', function(){
						$( "#addUserForm" ).dialog( "destroy" );
						//Abre modal para o usuário logar
						$( "#loginForm" ).dialog({
							modal: true,
							show: { effect: "slideDown", duration: 600 } ,
							width: 500,
						});
					}); 					
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
			pass1.html('A senha deve ter no mínimo 6 caracteres');
		} else {
			field1.removeClass('redBorder').addClass('greenBorder');
			$('#txtPassword2').attr('disabled', false);
			pass1.html('');
		}
	});
	$('#txtPassword2').keyup(function(){
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();

		if(password2.length < 6){
			field2.addClass('redBorder');
			pass2.html('As senhas não coincidem');
		} else if(password1 != password2) {
			field1.addClass('redBorder');
			field2.addClass('redBorder');
			pass2.html('As senhas não coincidem');
		} else {
			field1.removeClass('redBorder').addClass('greenBorder');
			field2.removeClass('redBorder').addClass('greenBorder');
			pass2.html('');
		}
	});

	//Verifica email e altera estilo
	$('#txtEmail').keyup(function(){
		var email = $(this).val();

	    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

	    if(pattern.test(email)){         
			emailField.removeClass('redBorder').addClass('greenBorder');
			emailReq.html('');
	    }else{   
			emailField.addClass('redBorder');
			emailReq.html('Email inválido').css('margin-left', '-80px');
	    }
	});
	$('#txtEmail').focusout(function(){
		var email = $(this).val();

		if($(this).val() == ''){
			emailField.addClass('redBorder');
			emailReq.html('Campo obrigatório');
		} else {
			$.ajax({
		    	url: 'php/checkUser.php',
		    	type: 'POST',
		    	data: { email: email },
		    	success: function(data){
		    		if(data == 1){
		    			emailField.addClass('redBorder');
						emailReq.html('Este email já esta sendo usado').css('margin-left', '-180px');
		    		} else {
		    			emailField.removeClass('redBorder').addClass('greenBorder');
						emailReq.html('');
		    		}
		    	}
		    });
		}
	});

	//Verifica nome e altera estilo
	$('#txtFirstName').focusout(function(){
		var firstName = $('#txtFirstName').val();

		if(firstName == ''){
			firstNameField.addClass('redBorder');
			firstNameReq.html('Campo obrigatório');
		} else {
			firstNameField.removeClass('redBorder').addClass('greenBorder');
			firstNameReq.html('');
		} 
	});

	//Verifica sobrenome e altera estilo
	$('#txtLastName').focusout(function(){
		var lastName = $('#txtLastName').val();

		if(lastName == ''){
			lastNameField.addClass('redBorder');
			lastNameReq.html('Campo obrigatório');
		} else {
			lastNameField.removeClass('redBorder').addClass('greenBorder');
			lastNameReq.html('');
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
				if(data[0] == 1){
					//Redireciona para a página principal do sistema
					window.location.href = "home.php";	
				} else {
					alert("Usuário e/ou senha incorreto.");
				}
				//alert(data[0]);
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

	//Botão cancelar do formulário para recuperar senha
	$('#btnCancelForgotpassForm').on('click', function(){
		$( "#formForgotPass" ).dialog( "destroy" );
	});

	//Recuperar senha
	$('#forgotPass').click(function(){
		$( "#loginForm" ).dialog( "destroy" );

		//Abre modal para o usuário recuperar senha
		$( "#formForgotPass" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});
	$('#btnRecoverPass').on('click', function(){
		var email = $('#txtUsernameRecover').val();
		
		if(emailRecoverField.hasClass('greenBorder')){
			$.ajax({
				type: 'POST',
				data:{ email: email },
				url: 'php/forgotPass.php',
				success: function(data){		

					if(data == 1){
						$('#passError').append('Não encontramos o e-mail informado em nossa base de dados').css('color', 'green');
						errorAppended = 1;
					} else {
						$('#passSend').append('Uma nova senha foi enviada para seu email').css('color', 'green');
					}
	
				}
			})
		}
	});

	//Verificar email do formulário para recuperar senha
	$('#txtUsernameRecover').keyup(function(){
		var email = $(this).val();

	    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

	    if(pattern.test(email)){         
			emailRecoverField.removeClass('redBorder').addClass('greenBorder');
			emailReqForgot.html('');
	    }else{   
			emailRecoverField.addClass('redBorder');
			emailReqForgot.html('Email inválido').css('margin-left', '-80px');
	    }
	})	
})