$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/

	//Esconde formulários e dialogs
	$( "#addUserForm" ).hide();
	$( "#loginForm" ).hide();
	$('#forgotPassForm').hide();
	$('#passError').hide();
	$('#passSend').hide();

	//Por padrão o campo "confirmar senha" é desabilitado
	$('#txtPassword2').attr('disabled', true);

	//Carrega campos
	var password1Field = $('#txtPassword1');
	var password2Field = $('#txtPassword2');
	var emailField = $('#txtEmail');
	var firstNameField = $('#txtFirstName');
	var lastNameField = $('#txtLastName');
	var userNameField = $('#txtUsername');
	var passwordField = $('#txtPassword');
	var emailRecoverField = $('#txtUsernameRecover');

	//Seta variaveis de controle
	var formSucess = 0;
	var erroMsgUpdate = true;

	//Campos para validação do formulário
	var firstNameReq = $('.firstNameReq');
	var lastNameReq = $('.lastNameReq');
	var emailReq = $('.emailReq');
	var emailReqForgot = $('.emailReqForgot');
	var pass1 = $('.pass1');
	var pass2 = $('.pass2');


	/***************************
	*	 Inicio das funções 	*
	****************************/

	/********* Modals *********/

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

	//Abre modal para recuperar senha
	$('#forgotPass').click(function(){
		$( "#loginForm" ).dialog( "destroy" );

		$( "#formForgotPass" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
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

	/********* Ações *********/

	//Adiciona usuário
	$('#btnAddUser').click(function(){

		//Carrega valores dos campos
		var firstName = $('#txtFirstName').val();
		var lastName = $('#txtLastName').val();
		var email = $('#txtEmail').val();
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();
		var gender = $('#gender').val();
		var product = $('#product').val();

		//Valida se todos os campos são validos só será permitido o envio do formulário caso
		//todos os campos sejam corrigidos
		if(password1Field.hasClass('redBorder') || password2Field.hasClass('redBorder') || emailField.hasClass('redBorder') || firstNameField.hasClass('redBorder') || lastNameField.hasClass('redBorder')){
			if (erroMsgUpdate) {
				$('#formMessage').append('Corrija os campos destacados').css('color', 'red');
				erroMsgUpdate = false;
			}
		} else {
			//Envia dados para adicionar usuário no banco
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
						//Remove mensagem de erro apontada pela validação do formulário, existindo ou não
						$('#formMessage').remove();

						//Exibe mensagem de sucesso e exibe link para o usuário logar
						$('#formMessageSuccess').append('Usuário cadastrado com sucesso').css('color', 'green');
						$('#formMessageSuccess').append("<a href = '#' id = 'loginLink' class = 'loginLink'>Login </a>");
						formSucess = 1;

						//Reseta formulário para o estado original
						$('#formAddTask')[0].reset();
						password1Field.removeClass('greenBorder');
						password2Field.removeClass('greenBorder');
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

	//Autentica usuário
	$('#btnLogin').click(function(){
		//Armazena usuário e senha dos campos de login
		var username = $('#txtUsername').val();
		var password = $('#txtPassword').val();

		//Envia os dados para autenticar o usuário
		$.ajax({
			url: 'php/logon.php',
			type: 'POST',
			data:{
				username: username,
				password: password
			},
			success: function(data){
				//Fecha o dialog de login
				$( "#loginForm" ).dialog( "destroy" );

				//Dependendo do retorno é realizada uma ação
				if(data[0] == 1){
					//Redireciona para a página principal do sistema
					window.location.href = "home.php";	
				} else {
					alert("Usuário e/ou senha incorreto.");
				}
			}
		})
	});

	//Envia senha por e-mail
	$('#btnRecoverPass').on('click', function(){
		//Armazena o valor 
		var email = $('#txtUsernameRecover').val();
		
		//Valida se o campo é valido
		if(emailRecoverField.hasClass('greenBorder')){
			$.ajax({
				type: 'POST',
				data:{ email: email },
				url: 'php/forgotPass.php',
				success: function(data){
					//Caso haja algum problema será exibido uma mensagem de erro		
					//caso contrário uma mensagem de sucesso
					if(data == 1){
						$('#passError').show();
						$('#passSend').hide();
					} else {
						$('#passSend').show();
						$('#passError').hide();
					}
				}
			})
		}
	});



	/********* Validações *********/

	//Validação do campo senha
	$('#txtPassword1').keyup(function(){
		//Armazena valores dos campos
		var password1 = $('#txtPassword1').val();

		//Verifica se a senha tem menos de seis caracteres ou se o campo esta em branco
		if(password1.length < 6 || password1 == ''){
			//Adiciona uma classe para informar que há um problema no campo
			password1Field.addClass('redBorder');
			//Exibe uma mensagem informando do que se trata o problema
			pass1.html('A senha deve ter no mínimo 6 caracteres');
		} else {
			//Caso a senha atenda os requisitos minimos, é adicionada uma classe
			//para identificar que o valor é valido
			password1Field.removeClass('redBorder').addClass('greenBorder');

			//Habilito o campo "confirmar senha" depois que o primeiro esteja correto
			$('#txtPassword2').attr('disabled', false);

			//Reseto a mensagem do campo com a primeira senha
			pass1.html('');
		}
	});

	//Validação do campo "confirmar senha"
	$('#txtPassword2').keyup(function(){
		//Armazena valores dos campos
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();

		//Valida se a senha tem menos de seis caracteres
		if(password2.length < 6){
			//Adiciona uma classe para informar que há um problema no campo
			password2Field.addClass('redBorder');

			//Exibe uma mensagem informando do que se trata o problema
			pass2.html('As senhas não coincidem');
		} else if(password1 != password2) {
			//Caso a segunda senha seja diferente da primeira, é adicionada uma classe
			//em ambos os campos para informar que há um problema
			password1Field.addClass('redBorder');
			password2Field.addClass('redBorder');

			//Exibe uma mensagem informando do que se trata o problema
			pass2.html('As senhas não coincidem');
		} else {
			//Caso a senha atenda os requisitos minimos, é adicionada uma classe
			//para identificar que o valor é valido
			password1Field.removeClass('redBorder').addClass('greenBorder');
			password2Field.removeClass('redBorder').addClass('greenBorder');

			//Reseto a mensagem do campo com a segunda senha
			pass2.html('');
		}
	});

	//Valida email enquanto campo é alterado
	$('#txtEmail').keyup(function(){
		//Armazena valores dos campos
		var email = $(this).val();

		//Expressão regular para validação do e-mail
	    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

	    //Se o e-mail atender os requisitos minimos é adicionada uma classe para
	    //identificar que o valor é valido
	    if(pattern.test(email)){         
			emailField.removeClass('redBorder').addClass('greenBorder');

			//Reseta mensagens de erro
			emailReq.html('');
	    }else{   
	    	//Caso haja algum problema é adicionada uma classe para
	    	//identificar o campo
			emailField.addClass('redBorder');

			//Exibe uma mensagem de erro para informar do que se trata o problema
			emailReq.html('Email inválido').css('margin-left', '-80px');
	    }
	});

	//Verificar email do formulário para recuperar senha
	$('#txtUsernameRecover').keyup(function(){
		//Armazena valores dos campos
		var email = $(this).val();

		//Expressão regular para validação do e-mail
	    var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;


	    //Se o e-mail atender os requisitos minimos é adicionada uma classe para
	    //identificar que o valor é valido
	    if(pattern.test(email)){ 
	    	//Caso o campo atenda os requisitos minimos, é adicionada uma classe para
			//identificar que este campo é valido      
			emailRecoverField.removeClass('redBorder').addClass('greenBorder');

			//Reseta mensagens de erro
			emailReqForgot.html('');
	    }else{   
	    	//Caso haja algum problema é adicionada uma classe para
	    	//identificar o campo
			emailRecoverField.addClass('redBorder');

			//Exibe uma mensagem de erro para informar do que se trata o problema
			emailReqForgot.html('Email inválido').css('margin-left', '-80px');
	    }
	});

	//Verifica se o campo e-mail esta vazio ou se já esta sendo usado por outro usuário
	$('#txtEmail').focusout(function(){
		//Armazeno valores dos campos
		var email = $(this).val();

		//Valida se o campo esta vazio
		if($(this).val() == ''){
			//Adiciona classe para identificar que o campo possui algum problema
			emailField.addClass('redBorder');

			//Exibe mensagem para informar do que se trata o problema
			emailReq.html('Campo obrigatório');
		} else {
			//Verifica se o e-mail já esta sendo usado por outro usuário
			$.ajax({
		    	url: 'php/checkUser.php',
		    	type: 'POST',
		    	data: { email: email },
		    	success: function(data){
		    		if(data == 1){
		    			//Adiciona uma classe no campo para identificar o problema
		    			emailField.addClass('redBorder');

		    			//Caso esteja sendo usado é apresentado uma mensagem para o usuário
						emailReq.html('Este email já esta sendo usado').css('margin-left', '-180px');
		    		} else {
		    			//Adiciona uma classe para identificar que o campo é valido
		    			emailField.removeClass('redBorder').addClass('greenBorder');

		    			//Reseta mensagens de erro
						emailReq.html('');
		    		}
		    	}
		    });
		}
	});

	//Verifica nome e altera estilo
	$('#txtFirstName').focusout(function(){
		//Armazena valores dos campos
		var firstName = $('#txtFirstName').val();

		//Verifica se o campo esta vazio
		if(firstName == ''){
			//Adiciona classe para identificar um problema no campo
			firstNameField.addClass('redBorder');

			//Exibe mensagem para mostrar do que se trata o problema
			firstNameReq.html('Campo obrigatório');
		} else {
			//Caso o campo atenda os requisitos minimos, é adicionada uma classe para
			//identificar que este campo é valido
			firstNameField.removeClass('redBorder').addClass('greenBorder');

			//Remove mensagens de erro
			firstNameReq.html('');
		} 
	});

	//Verifica sobrenome e altera estilo
	$('#txtLastName').focusout(function(){
		//Armazena valores dos campos
		var lastName = $('#txtLastName').val();

		//Verifica se o campo esta vazio
		if(lastName == ''){
			//Adiciona classe para identificar um problema no campo
			lastNameField.addClass('redBorder');

			//Exibe mensagem para mostrar do que se trata o problema
			lastNameReq.html('Campo obrigatório');
		} else {
			//Caso o campo atenda os requisitos minimos, é adicionada uma classe para
			//identificar que este campo é valido
			lastNameField.removeClass('redBorder').addClass('greenBorder');

			//Remove mensagens de erro
			lastNameReq.html('');
		} 

	});
})