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

	//Mensagens
	$('.categoryMsgError').hide();
	$('.displayError').hide();
	$('.categoryMsgSuccess').hide();


    /***************************
	* Inicio das funções 
	****************************/
	$( document ).ajaxStart(function() {
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
	  	$('.loader').hide();
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
					categoryTypeId: categoryTypeId
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
	
});