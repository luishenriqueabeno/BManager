$(document).ready(function(){

	/***************************
	* Variaveis de inicialização
	****************************/

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Esconde mensagens
	$('.senhaAtualMsg').hide();
	$('.senhaNewMsg').hide();


	/***************************
	* Inicio das funções 
	****************************/

	//Valida se o campo com a senha atual enquanto o usuário digita
	$('#actualPass').keyup(function(){
		//Guardo valor do campo com a senha antiga
		var password = $('#actualPass').val();

		//Verifica se o campo esta vazio
		if($(this).val() == '' || password.length < 6){
			$(this).removeClass('greenBorder');
			$(this).addClass('redBorder');
			$('.senhaAtualMsg').show();
		} else {
			$(this).removeClass('redBorder');
			$(this).addClass('greenBorder');
			$('.senhaAtualMsg').hide();
		}
	});

	//Valida se o campo com a senha atual foi preenchido após perder o foco
	$('#actualPass').focusout(function(){
		//Guardo valor do campo com a senha antiga
		var password = $('#actualPass').val();

		if($(this).val() == '' || password.length < 6){
			$(this).removeClass('greenBorder');
			$(this).addClass('redBorder');
			$('.senhaAtualMsg').show();
		} else {
			$(this).removeClass('redBorder');
			$(this).addClass('greenBorder');
			$('.senhaAtualMsg').hide();
		}
	});

	//Verifica se a senha digitada no campo nova senha corresponde os requisitos minimos enquanto o usuário digita
	$('#newPass').keyup(function(){
		//Guardo valor do campo com a nova senha
		var password = $('#newPass').val();

		if($(this).val() == '' || password.length < 6){
			$(this).removeClass('greenBorder');
			$(this).addClass('redBorder');
			$('.senhaNewMsg').show();
		} else {
			$(this).removeClass('redBorder');
			$(this).addClass('greenBorder');
			$('.senhaNewMsg').hide();
		}
	});

	//Verifica se a senha digitada no campo nova senha corresponde os requisitos minimos ão perder o foco
	$('#newPass').focusout(function(){
		if($(this).val() == '' || password.length < 6){
			$(this).removeClass('greenBorder');
			$(this).addClass('redBorder');
			$('.senhaNewMsg').show();
		} else {
			$(this).removeClass('redBorder');
			$(this).addClass('greenBorder');
			$('.senhaNewMsg').hide();
		}
	});

	//Envia formulário para alterar senha
	$('#btnChangePass').on('click', function(){
		var actualPass = $('#actualPass').val();
		var newPass = $('#newPass').val();

		//Verifico se os campos de senha foram preenchidos corretamente
		if($('#actualPass').hasClass('redBorder') || $('#newPass').hasClass('redBorder')){
			$('.message').html('Favor corrija os campos destacados');
			$('.message').css('color', 'red');
		} else {
			//Envio via ajax os dados para trocar a senha
			$.ajax({
				url: 'modules/Gerencial/php/changePass.php',
				type: 'POST',
				data:{
					userId: userId,
					actualPass: actualPass,
					newPass: newPass
				},
				success: function(data){
					//Verifica retorno do back end
					if(data == 1){
						//Mostra mensagem dizendo que ocorreu tudo certo
						$('.message').html('Senha alterada com sucesso');
						$('.message').css('color', 'green');
					} else {
						//Mostra mensagem de erro informando que a senha atual difere do que esta cadastrado no banco
						//retorna o foco no campo e adiciona estilo para destaca-lo
						$('#actualPass').focus();
						$('.message').html('Senha atual inválida');
						$('.message').css('color', 'red');
						$('#actualPass').removeClass('greenBorder');
						$('#actualPass').addClass('redBorder');
					}
				}
			})
		}

		
	})

	

});