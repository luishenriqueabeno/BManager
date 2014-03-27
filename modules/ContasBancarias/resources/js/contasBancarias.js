$(document).ready(function(){
	
	/****************************
	* Variaveis de inicialização *
	*****************************/


	//Esconde formulários e dialogs
	$('#addBankForm').hide();
	$('.formManagerContact').hide();
	$('#deleteDialog').hide();

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

		//Limpa formulário
		$('#formAddBank')[0].reset();

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
		var hidenId = $('input[name=bankId]').val();

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
				userId: userId,
				hidenId: hidenId
			},
			success: function(data){
				//Limpa mensagens
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

	 //Carrega dados da conta bancária para edição
    $('#bankList').on('dblclick', 'tr', function(){
    	//Limpa mensagens
		$('.msg').html('');

		//Limpa formulário
		$('#formAddBank')[0].reset();

    	//Campos do formulário
    	var bankId = $(this).attr('id');
    	var hidenId = $('input[name=bankId]');
    	var bankName = $('#txtBankName');
		var txtAgNumber = $('#txtAgNumber');
		var txtAccNumber = $('#txtAccNumber');
		var txtManagerName = $('#txtManagerName');
		var txtManagerTel = $('#txtManagerTel');
		var txtManagerEmail = $('#txtManagerEmail');

    	//Envia id da conta bancária
    	$.ajax({
    		url: 'modules/ContasBancarias/php/editaContaBancaria.php',
    		type: 'POST',
    		data:{ bankId: bankId },
    		success: function(data){
    			var bank = $.parseJSON(data);

    			//Altera texto do botão
    			$('#btnAddBank span').html('Gravar');

    			//Exibe modal preenchido
				$( "#addBankForm" ).dialog({
					modal: true,
					show: { effect: "slideDown", duration: 600 } ,
					width: 500,
				});

				//Preenche modal com as informações retornadas
    			for(var i = 0; i < bank.length; i++){
    				hidenId.val(bank[i].id);
    				bankName.val(bank[i].banco);
    				txtAgNumber.val(bank[i].agencia);
    				txtAccNumber.val(bank[i].conta);
    				txtManagerName.val(bank[i].nomeGerente);
    				txtManagerTel.val(bank[i].telGerente);
    				txtManagerEmail.val(bank[i].emailGerente);
    			}
    		}
    	});

    });

	//Remove contas bancárias selecionadas
	$('#removeBank').on('click', function(){
		var i = 0;
		//Cria array para armazenar contas bancárias selecionadas
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		//Caso haja itens selecionados abre dialog com mensagem questionando sobre a exclusão
		if(checkSelected.length > 0){
			$( "#deleteDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					//Se o usuário clicar em 'Sim', as contas bancárias selecionadas serão excluidas do banco
					"Sim": function() {
						var i = 0;

						//Cria array para armazenar o id das contas
						var banks = [];

						//Para cada conta selecionada é armazenado o id no array
						$('.highlighted').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							banks[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/ContasBancarias/php/deletaContasBancarias.php',
							data: { banks: banks },
							success: function(data){
								//Não faz nada em caso de sucesso
							}
						});

						$( this ).dialog( "close" );
					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		} else {
			//Caso o usuário não confirme a exclusão o dialog é fechado
			$( "#deleteDialogSelected" ).dialog({
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	});

});