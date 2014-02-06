$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/

	var userId = $('input[name=userId]').val();
	$( "#addUserForm" ).hide();
	$('#txtPassword2').attr('disabled', true);
	var field1 = $('#txtPassword1');
	var field2 = $('#txtPassword2');
	var emailField = $('#txtEmail');
	var firstNameField = $('#txtFirstName');
	var lastNameField = $('#txtLastName');
	var userNameField = $('#txtUsername');
	var passwordField = $('#txtPassword');

	var firstNameReq = $('.firstNameReq');
	var lastNameReq = $('.lastNameReq');
	var emailReq = $('.emailReq');
	var emailReqForgot = $('.emailReqForgot');
	var pass1 = $('.pass1');
	var pass2 = $('.pass2');
	var userList = $('#userList');

	userListLoad();


	/***************************
	* Inicio das funções 
	****************************/
	//Abre modal para adicionar usuário
	$('#addUser').click(function(){
		//Exibe modal
		$( "#addUserForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Botão cancelar do formulário para inscrição
	$('#btnCancelUserForm').on('click', function(){
		$( "#addUserForm" ).dialog( "destroy" );
	});

	//Função para carregar usuários relacionados à empresa/pessoa
	function userListLoad(){
		$.ajax({
			url: 'modules/Gerencial/php/carregaUsuarios.php',
			type: 'POST',
			data:{ userId: userId },
			success: function(data){

				var json = $.parseJSON(data);
				
				for(var i = 0; i < json.length; i++){

					if(json[i].usertype == '1'){
						json[i].usertype = 'Master';
					}

					userList.append(
						"<tr id = "+ json[i].id +">" + 
							"<td>" + json[i].firstName + ' ' + json[i].lastName + "</td>" +
							"<td>" + json[i].email + "</td>" +
							"<td>" + json[i].usertype + "</td>" +
							"<td> Editar </td>" +
						"</tr>"
					)

				}
			}
		});
	}

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
		    	url: 'modules/Gerencial/php/checkUser.php',
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

	//Muda cor da linha dependendo do status da tarefa
	$('.userList').on('click', 'tr:not(:first-child)', function () {
		if($(this).hasClass("highlighted")){
			$(this).removeClass('highlighted');
		} else {
			$(this).addClass('highlighted');
		}
	});
});