$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/
	$( "#addUserForm" ).hide();


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

	//Adiciona usuário
	$('#btnAddUser').click(function(){
		var firstName = $('#txtFirstName').val();
		var lastName = $('#txtLastName').val();
		var email = $('#txtEmail').val();
		var password1 = $('#txtPassword1').val();
		var password2 = $('#txtPassword2').val();
		var product = $('#product').val();

		if(password1 != password2){
			alert("A senha não confere");
		} else {
			$.ajax({
				type: 'POST',
				url: 'php/addUser.php',
				data:{
					firstName: firstName,
					lastName: lastName,
					email: email,
					password1: password1,
					product: product
				},
				success: function(data){
					alert(data);
				}
			});
		}

	});

	//Verifica se as senhas são iguais
	$('#txtPassword2').keyup(function(){
		var password1 = $('#txtPassword1').val();
		var password2 = $(this).val();

		var field1 = $('#txtPassword1');
		var field2 = $('#txtPassword2');

		if(password1 != password2){
			field1.addClass('redBorder');
			field2.addClass('redBorder');
		} else {
			field1.removeClass('redBorder').addClass('greenBorder');
			field2.removeClass('redBorder').addClass('greenBorder');
		}
	});

	//Botão cancelar do formulário
	$('#btnCancelUserForm').on('click', function(){
		$( "#addUserForm" ).dialog( "destroy" );
	});
})