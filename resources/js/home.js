$(document).ready(function(){
	/***************************
	* Variaveis de inicialização
	****************************/
	var contentMainArea = $('#contentMainArea');


	/***************************
	* Inicio das funções 
	****************************/

	//Adiciona o modulo de tarefas a página
	$("a[name=modulesTasks]").click(function () { 
		$("#frame").attr("src", "modules/MyTasks/index.php");		
	});

})