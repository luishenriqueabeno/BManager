$(document).ready(function(){
	/***************************
	* Variaveis de inicialização 
	****************************/
	var userId = $('input[name=userId]').val();
	var expenseCategory = $('select[name=expenseCategory]');
	var incomeCategory = $('select[name=incomeCategory]');
	var monthTableCategoryExpenses = $('#listCategoriesExpenses');
	var monthTableCategoryIncomes = $('#listCategoriesIncomes');
	
	listaComAnoAtual();

	//Esconde dialog no carregamento
	$('#addCategoryForm').hide();
	$('#deleteDialog').hide();

	//Mensagens
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.categoryMsgSuccess').hide();

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

	//Seleciona categoria
	$('#listCategoriesExpenses, #listCategoriesIncomes').on('click', 'tr:not(:last-child)', function () {
		if($(this).hasClass("highlighted")){
			$(this).removeClass('highlighted');
		} else {
			$(this).addClass('highlighted');
		}
	});

	function listaComAnoAtual(){
		monthTableCategoryExpenses.empty();
		monthTableCategoryIncomes.empty();

		var ano = "";

		//Carrega categorias de natureza despesa
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableCategoryExpenses).append(data);
			}
		});

		//Carrega categorias de natureza receitas
		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableCategoryIncomes).append(data);
			}
		});
	}
	
	//Criar uma categoria
	$('#addCategory').on('click', function(){
		$('#formAddCategory')[0].reset();
		$('.categoryMsgSuccess').hide();
		$('.categoryMsgError').hide();
		$('.displayError').hide();
		$('#txtCategoryName').removeClass("redBorder");

		//Exibe modal
		$( "#addCategoryForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
		});
	});
	
	//Adiciona categoria no banco
	$('#btnAddCategory').on('click', function(){
		var categoryName = $('#txtCategoryName').val();
		var categoryTypeId = $('input[name=categoryType]:checked').val();
		var ano = $('#anoSelect').val();

		if(categoryName == ''){
			$('#txtCategoryName').addClass("redBorder");
			$('.categoryMsgSuccess').hide();
			$('.categoryMsgError').hide();
			$('.displayError').show();
		} else {
			$.ajax({
				type: 'POST',
				url: 'modules/CashFlow/php/addCategory.php',
				data:{
					userId: userId,
					categoryName: categoryName,
					categoryTypeId: categoryTypeId,
					ano: ano
				},
				success: function(data){
					if(data == 2){
						$('.categoryMsgError').show();
						$('.categoryMsgSuccess').hide();
						$('.displayError').hide();
					} else {
						expenseCategory.empty();
						incomeCategory.empty();
						$('.categoryMsgError').hide();
						$('.categoryMsgSuccess').show();
						$('.displayError').hide();

						var json = $.parseJSON(data);

						for(var i = 0; i < json.length; i++){
							if(json[i].categoryTypeId == 1){
								expenseCategory.append(
									"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
								);
							} else {
								incomeCategory.append(
									"<option value = " + json[i].id + ">" + json[i].categoryName + "</option>"
								);
							}
						}
					}
				}
			})
		}
		
	});

	//Botão cancelar do formulário
	$('#btnCancelCategoryForm').on('click', function(){
		$( "#addCategoryForm" ).dialog( "destroy" );
	});

	//Carrega receitas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableCategoryIncomes.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesIncomes.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableCategoryIncomes).append(data);
			}
		});
	});

	//Carrega despesas ao selecionar o ano
	$('#anoSelect').change(function(){
		var ano = $('#anoSelect').val();
		monthTableCategoryExpenses.empty();

		$.ajax({
			type: 'POST',
			url: 'modules/CashFlow/php/loadCategoriesExpenses.php',
			data:{
				ano: ano,
				userId: userId
			},
			success: function(data){
				$(monthTableCategoryExpenses).append(data);
			}
		});
	});

	//Remove categorias selecionadas
	$('#removeCategory').on('click', function(){
		var i = 0;
		var checkSelected = [];

		var ano = $('#anoSelect').val();

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
						var categories = [];

						$('.highlighted').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							categories[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/CashFlow/php/deletaCategorias.php',
							data: { 
								categories: categories,
								userId: userId
							},
							success: function(data){
								console.log(data);
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