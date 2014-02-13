$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var incomeCategory = $('select[name=incomeCategory]');
	var monthTableIncomes = $('#listIncomes');
	listaComAnoAtual();
	loadCategories();

	//Esconde dialog no carregamento
	$('#addIncomeForm').hide();	
	$('#deleteDialog').hide();

	//Mensagens
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.incomeAddSuccess').hide();

    //Date picker
    $( "#incomeDate" ).datepicker({
    	altFormat: "dd/mm/yyy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    //Mask money
	$("#txtIncomeValue").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

	//Pega ano atual e troca no select
	$('#anoSelect').val(new Date().getFullYear()).attr('selected');


    /***************************
	* Inicio das funções 
	****************************/
	$( document ).ajaxStart(function() {
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
	  	$('.loader').hide();
	});

	//Seleciona receita
	$('#listIncomes').on('click', 'tr:not(:last-child)', function () {
		if($(this).hasClass("highlighted")){
			$(this).removeClass('highlighted');
		} else {
			$(this).addClass('highlighted');
		}
	});

	function reloadMonthTable(){
		var ano = $('#anoSelect').val();
		monthTableIncomes.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});

	}

	function listaComAnoAtual(){
		monthTableIncomes.empty();

		var ano = "";

		//Carrega receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});
	}

	//Carrega receitas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableIncomes.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableIncomes).append(data);
			}
		});
	});

	//Adicionar receita
	$('#addIncome').on('click', function(){
		$('#formAddIncome')[0].reset();
		$('.incomeAddSuccess').hide();
		$('.displayError').hide();
		$('#txtIncomeName').removeClass("redBorder");

		//Exibe modal
		$( "#addIncomeForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});

	//Adiciona receita no banco
	$('#btnAddIncome').on('click', function(){
		var incomeName = $('#txtIncomeName').val();
		var ano = $('#anoSelect').val();
		var incomeValue = $('#txtIncomeValue').val();
		var category = $('select[name=incomeCategory]').find(":selected").val();

		if(incomeName == ''){
			$('#txtIncomeName').addClass("redBorder");
			$('.incomeAddSuccess').hide();
			$('.displayError').show();
		} else {
			$.ajax({
				type: 'POST',
				url: 'modules/CashFlow/php/addIncome.php',
				data:{
					userId: userId,
					incomeName: incomeName,
					incomeValue: incomeValue,
					ano: ano,
					category: category
				},
				success: function (data){
					if(data == 1){
						$('.incomeAddSuccess').show();
						$('.displayError').hide();
						reloadMonthTable();
					}
				}
			});	
		}
		
	});

	//Botão cancelar do formulário
	$('#btnCancelIncomeForm').on('click', function(){
		$( "#addIncomeForm" ).dialog( "destroy" );
	});

	//Carrega categorias ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		incomeCategory.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				var json = $.parseJSON(data);

				for(var i = 0; i < json.length; i++){
					if(json[i].categoryTypeId == 2){
						incomeCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	});

	function loadCategories(){
		var ano = new Date().getFullYear();

		//Carrega categorias
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategories.php',
			data:{
				userId: userId,
				ano: ano
			},
			success: function (data){			
				var json = $.parseJSON(data);

				for(var i = 0; i < json.length; i++){
					if(json[i].categoryTypeId == 2){
						incomeCategory.append(
							"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
						);
					}
				}
			}
		});
	}

	//Edição dos dados diretamente na tabela
	
	 $('#listIncomes').on('click', 'td:not(.total, :first-child)', function(){ 
		var conteudoOriginal = $(this).text(); 
		var rowId = $(this).parent().attr('id');
		var month = $(this).attr('class');
		var ano = $('#anoSelect').val();

		//Muda estilo para edição
		$(this).addClass("celulaEmEdicao"); 

		//Altera campo para um input que recebe como valor o conteúdo original
		$(this).html("<input type='text' value='" + conteudoOriginal + "' />"); 

		//Foca no input
		$(this).children().first().focus(); 

		//Se o input "ouvir" um enter é feito um update na tabela
		$(this).children().first().keypress(function (e) { 
			if (e.which == 13) { 
				var novoConteudo = $(this).val(); 
				$(this).parent().text(novoConteudo); 
				$(this).parent().removeClass("celulaEmEdicao"); 

				$.ajax({
					url: 'modules/CashFlow/php/updateTableField.php',
					data: { 
						novoConteudo: novoConteudo,
						rowId: rowId,
						month: month,
						userId: userId,
						ano: ano
					},
					type: 'POST',
					success: function(data){
						reloadMonthTable();
					}
				})
			} 
		}); 

		//Volta campo para o estado original
		$(this).children().first().blur(function(){ 
			$(this).parent().text(conteudoOriginal); 
			$(this).parent().removeClass("celulaEmEdicao"); 
		});
	});

	//Remove despesas selecionadas
	$('#removeIncome').on('click', function(){
		var i = 0;
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		if(checkSelected.length > 0){
			$( "#deleteDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					"Sim": function() {
						var i = 0;
						var incomes = [];

						$('.highlighted').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							incomes[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/CashFlow/php/deletaReceitas.php',
							data: { incomes: incomes },
							success: function(data){

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