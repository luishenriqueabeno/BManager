$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/
	var contentMainArea = $('#contentMainArea');


	/***************************
	* Inicio das funções 
	****************************/

	//Adiciona estilo para item ativo do menu
	$('.navbar-nav li').on('click', function(){
		$('.navbar-nav li').each(function(){
			$(this).removeClass('active');	
		});		
		$(this).addClass('active');
	})


	//Adiciona o modulo de tarefas a página
	$("a[name=modulesTasks]").click(function () { 
		$('#contentMain').load('modules/MyTasks/index.php');
	});

	//Adiciona o modulo de fluxo de caixa a página
	$("a[name=modulesCashFlow]").click(function () { 
		$('#contentMain').load('modules/CashFlow/index.php');
	});

})