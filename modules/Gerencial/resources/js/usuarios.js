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
	var erroMsgUpdate = true;
	var formSucess = 0;

	var firstNameReq = $('.firstNameReq');
	var lastNameReq = $('.lastNameReq');
	var emailReq = $('.emailReq');
	var emailReqForgot = $('.emailReqForgot');
	var pass1 = $('.pass1');
	var pass2 = $('.pass2');
	var userList = $('#userList');
	userList.hide();

	userListLoad();


	/***************************
	* Inicio das funções 
	****************************/
	$( document ).ajaxStart(function() {
		userList.hide();
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
	  	$('.loader').hide();
	  	userList.show();
	});

	//Abre modal para adicionar usuário
	$('#addUser').click(function(){
		$('#formAddUser')[0].reset();
		$('#txtEmail').attr('disabled', false);

		$('#userIdEdit').val('');

		$('#cashFlow').attr('checked', false);    	
		$('#estoque').attr('checked', false);   
		$('#cashFlow').attr('disabled', false); 
		$('#estoque').attr('disabled', false);

		$('#formMessageSuccess').html('');

		//Exibe modal
		$( "#addUserForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adiciona usuário
	$('#btnAddUser').click(function(){
		var firstName = $('#txtFirstName').val();
		var lastName = $('#txtLastName').val();
		var email = $('#txtEmail').val();
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();
		var gender = $('#gender').val();
		var modulesPermission = [];
		var checkmd = $('#checkmd').val();

		var userIdEdit = $('#userIdEdit').val();

		var i = 0;

		$('input[type=checkbox]:checked').each(function(){
			modulesPermission[i] = $(this).val();
			i++;
		});
	
		if(field1.hasClass('redBorder') || field2.hasClass('redBorder') || emailField.hasClass('redBorder') || firstNameField.hasClass('redBorder') || lastNameField.hasClass('redBorder')){
			if (erroMsgUpdate) {
				$('#formMessage').html('Corrija os campos destacados').css('color', 'red');
				erroMsgUpdate = false;
			}
		} else {
			$.ajax({
				type: 'POST',
				url: 'modules/Gerencial/php/addUser.php',
				data:{
					userIdEdit: userIdEdit,
					userId: userId,
					firstName: firstName,
					lastName: lastName,
					email: email,
					password1: password1,
					gender: gender,
					modulesPermission: modulesPermission,
					checkmd: checkmd
				},
				success: function(data){
					if(formSucess == 0){
						$('#formMessage').remove();
						$('#formMessageSuccess').html(data).css('color', 'green');
						formSucess = 1;
						$('#formAddUser')[0].reset();
						field1.removeClass('greenBorder');
						field2.removeClass('greenBorder');
						firstNameField.removeClass('greenBorder');
						lastNameField.removeClass('greenBorder');
						emailField.removeClass('greenBorder');
						userListLoad();
					} else {
						$('#formMessageSuccess').html(data).css('color', 'green');
						userListLoad();
					}
				}
			});
		}
	});

	//Botão cancelar do formulário para inscrição
	$('#btnCancelUserForm').on('click', function(){
		$( "#addUserForm" ).dialog( "destroy" );
	});

	//Função para carregar usuários relacionados à empresa/pessoa
	function userListLoad(){
		$('#userList tr').not(':first-child').empty();

		$.ajax({
			url: 'modules/Gerencial/php/carregaUsuarios.php',
			type: 'POST',
			data:{ userId: userId },
			success: function(data){

				var json = $.parseJSON(data);	

				for(var i = 0; i < json.length; i++){
					
					if(json[i].userType == '1'){
						json[i].userType = 'Master';
					}

					userList.append(
						"<tr id = "+ json[i].id +">" + 
							"<td>" + json[i].firstName + ' ' + json[i].lastName + "</td>" +
							"<td>" + json[i].email + "</td>" +
							"<td>" + json[i].userType + "</td>" +
						"</tr>"
					)

				}
			}
		});
	}

    //Carrega dados do usuário para edição
    $('#userList').on('dblclick', 'tr', function(){
    	var userId = $(this).attr('id');
    	var firstName = $('#txtFirstName');
		var lastName = $('#txtLastName');
		var email = $('#txtEmail').attr('disabled', true);
		var password1 = $('#txtPassword1');
		var password2 = $('#txtPassword2');
		var gender = $('#gender');
		$('#checkmd').val('1');

		var userIdEdit = $('#userIdEdit').val(userId);

    	$.ajax({
    		url: 'modules/Gerencial/php/editaUsuario.php',
    		type: 'POST',
    		data:{ userId: userId },
    		success: function(data){

    			var user = $.parseJSON(data);

    			$('#formMessageSuccess').html('');

    			//Exibe modal preenchido
				$( "#addUserForm" ).dialog({
					modal: true,
					show: { effect: "slideDown", duration: 600 } ,
					width: 500,
				});

    			for(var i = 0; i < user.length; i++){
    				firstName.val(user[i].firstName);
    				email.val(user[i].email);
    				lastName.val(user[i].lastName);
    				password1.val(user[i].password);
    				password2.val(user[i].password);
    				gender.val(user[i].gender);
    			}

    			var arr = user[0].userType.split(',');

    			for(i = 0; i< arr.length; i++){
    				if(arr[i] == 2){
    					$('#cashFlow').attr('checked', true);   
    					$('#cashFlow').attr('disabled', false); 
    				} else if(arr[i] == 3){
    					$('#estoque').attr('checked', true);   
    					$('#estoque').attr('disabled', false); 
    				} else if(arr[i] == 1){
    					$('#cashFlow').attr('checked', true);    	
    					$('#estoque').attr('checked', true);   
    					$('#cashFlow').attr('disabled', true); 
    					$('#estoque').attr('disabled', true); 
    				}
    			}
    		}
    	});

    });


	//Verifica senhas e altera estilo
	$('#txtPassword1').keyup(function(){
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();
		$('#checkmd').val('2');

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
		$('#checkmd').val('2');

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
		var userIdEdit = $('#userIdEdit').val();

		if($(this).val() == ''){
			emailField.addClass('redBorder');
			emailReq.html('Campo obrigatório');
		} else {
			$.ajax({
		    	url: 'modules/Gerencial/php/checkUser.php',
		    	type: 'POST',
		    	data: { 
		    		email: email,
		    		userIdEdit: userIdEdit
		    	},
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