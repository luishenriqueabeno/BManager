$(document).ready(function(){
	
	/****************************
	* Variaveis de inicialização *
	*****************************/


	//Esconde formulários e dialogs
	$('#addBankForm').hide();
	$('.formManagerContact').hide();

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Masked input
  	$("#txtManagerTel").mask("(99) 9999-9999");

  	/***************************
	*	 Inicio das funções   	*
	****************************/

	//Para qualquer requisição ajax é adicionado um loader na página
	$( document ).ajaxStart(function() {
		//Exibe o loader até que a requisição seja concluída
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
		//Ao terminar uma requisição o loader é escondido
	  	$('.loader').hide();
	});

	/********* Modals *********/
	//Abre modal para adicionar conta bancária
	$('#addBank').on('click', function(){
		//Exibe modal
		$( "#addBankForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
			//height: 500
		});

	});

	//Botão cancelar do formulário
	$('#btnCancelBankForm').on('click', function(){
		$( "#addBankForm" ).dialog( "destroy" );
	});

	/********* Ações *********/

	//Auto complete dos bancos
	$(function() {
		$.ajax({
			type: 'POST',
			url: 'modules/ContasBancarias/php/carregaBancos.php',
			success: function(data){
				var json = $.parseJSON(data);

				var bancos = [];

				for(var i = 0; i < json.length; i++){
					bancos[i] = json[i].codigo + " - " + json[i].banco;
				}

				$( "#txtBankName" ).autocomplete({
					source: bancos
				});
			}
		});
	});

	//Adiciona conta bancária no banco
	$('#btnAddBank').on('click', function(){
		alert("OK");
	})

	//Mostra formulário para adicionar contato do gerente
	$('#addManagerContact').on('click', function(){
		$('.formManagerContact').toggle();
	});

});