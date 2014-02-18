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

	

});