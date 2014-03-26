$(document).ready(function(){
	
	/****************************
	* Variaveis de inicialização *
	*****************************/


	//Esconde formulários e dialogs
	$('#addBankForm').hide();
	$('.formManagerContact').hide();

	//Tabela contas bancarias
	var bankList = $('#bankList');

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Masked input
  	$("#txtManagerTel").mask("(99) 9999-9999");

  	//Carrega contas bancárias na inicilização
  	reloadContasBancarias ();

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
		//Limpa mensagens
		$('.msg').html('');

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

	//Muda cor da linha ao passar o mouse o selecionar alguma linha
	$('.bankList').on('click', 'tr:not(:first-child)', function () {

		if($(this).hasClass("highlighted")){
			//Se o item já estiver selecionada a classe 'highlithed' é removida
			$(this).removeClass('highlighted');
		} else {
			//Caso o item seja já esteja selecionado, é adicionado a classe 'highlited'
			$(this).addClass('highlighted');
		}
	});

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

	//Recarrega contas bancárias
	function reloadContasBancarias (){
		//Limpa tabela
		$('#bankList tr:not(:first-child)').empty();

		$.ajax({
			url: 'modules/ContasBancarias/php/carregaContaBancaria.php',
			type: 'POST',
			data:{
				userId: userId
			},
			success: function(data){
				//Parseia resultado JSON
				var json = $.parseJSON(data);

				//Monta tabela com contas bancárias
				for(var i = 0; i < json.length; i++){
					if(json[i].taskStatus != 1){
						bankList.append(
							"<tr id = "+ json[i].id +">" + 
								"<td>" + json[i].banco + "</td>" +
								"<td>" + json[i].agencia + "</td>" +
								"<td>" + json[i].conta + "</td>" +
								"<td>" + json[i].nomeGerente + "</td>" +
							"</tr>"
						)
					}
				}
			}
		})
	}

	//Adiciona conta bancária no banco
	$('#btnAddBank').on('click', function(e){
		e.preventDefault();
		e.stopImmediatePropagation();

		//Campos que serão enviados via Ajax
		var bankName = $('#txtBankName').val();
		var txtAgNumber = $('#txtAgNumber').val();
		var txtAccNumber = $('#txtAccNumber').val();
		var txtManagerName = $('#txtManagerName').val();
		var txtManagerTel = $('#txtManagerTel').val();
		var txtManagerEmail = $('#txtManagerEmail').val();

		//Envia dados
		$.ajax({
			url: 'modules/ContasBancarias/php/cadastraContaBancaria.php',
			type: 'POST',
			data: {
				bankName: bankName,
				txtAgNumber: txtAgNumber,
				txtAccNumber: txtAccNumber,
				txtManagerName: txtManagerName,
				txtManagerTel: txtManagerTel,
				txtManagerEmail: txtManagerEmail,
				userId: userId
			},
			success: function(data){
				$('#formAddBank')[0].reset();

				$('.msg').html(data);
				//Caso haja retorno, recarrega tabela
				reloadContasBancarias();
			}
		})
	})

	//Mostra formulário para adicionar contato do gerente
	$('#addManagerContact').on('click', function(){
		$('.formManagerContact').toggle();
	});

});