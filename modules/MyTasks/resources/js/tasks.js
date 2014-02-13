$(document).ready(function(){

	/****************************
	* Variaveis de inicialização *
	*****************************/
	//Carrega campos
	var taskList = $('#taskList');

	//Esconde formulários e dialogs
	$('#deleteDialog').hide();
	$('#deleteDialogSelected').hide();
	$('#doneDialog').hide();
	$('#alreadyDoneDialog').hide();
	$('#addTaskForm').hide();
	$('#addGroupForm').hide();
	taskList.hide();

	//Adiciona classe para destacar que o item selecionado e inicial
	//são as tarefas não concluídas
	$('#typeUndone').addClass('activeTaskTypeUndone');

	//Armazena data inicial e fata final dos campos
	var dataInicio = $('#dataInicio').val();
	var dataFim = $('#dataFim').val();

	//Armazena id do usuário logado
	var userId = $('input[name=userId]').val();

	//Carrega tarefas na inicialização
	taskListLoad();

	//Date picker para data inicial
    $( "#dataInicio" ).datepicker({
    	altFormat: "dd/mm/yyy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    //Date picker para data final
    $( "#dataFim" ).datepicker({
    	altFormat: "dd/mm/yy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });
	
	/***************************
	*	 Inicio das funções 	*
	****************************/

	//Para qualquer requisição ajax é adicionado um loader na página
	$( document ).ajaxStart(function() {
		//Exibe o loader até que a requisição seja concluída
		$('.loader').show();
	});
	$( document ).ajaxStop(function() {
		//Ao terminar uma requisição o loader é escondido
	  	$('.loader').hide();

	  	//Ao terminar de carregar o conteúdo, as tarefas são exibidas novamente
	  	taskList.show();
	});

	/********* Modals *********/

	//Abre modal para adicionar tarefa
	$('#addTask').on('click', function(){
		//Altera texto botão do modal
		$('#btnAddTask span').html('Adicionar');

		//Como se trata da adição do usuário, o campo id deve ser nulo
		$('input[name=taskId]').val('');

		//Limpa valores dos campos
		clearFields();

		//Exibe modal
		$( "#addTaskForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
			//height: 500
		});

	});

	//Botão cancelar do formulário
	$('#btnCancelTaskForm').on('click', function(){
		$( "#addTaskForm" ).dialog( "destroy" );
	});

	/********* Ações *********/

	//Função para limpar valores dos campos no formulário
    function clearFields(){
    	var taskName = $('input[name=txtTaskName]').val('');
		var taskDesc = $('textarea[name=txtTaskDesc]').val('');
		var dataInicio = $('#dataInicio').val('');
		var dataFim = $('#dataFim').val('');
		
		//Hora e minuto
		var horaInicio = $('#horaInicio').val('');
		var minutoInicio = $('#minutoInicio').val('');
		var horaFim = $('#horaFim').val('');
		var minutoFim = $('#minutoFim').val('');
    }

	//Lista todas as tarefas não concluídas
	function taskListLoad(){
		$.ajax({
			url: 'modules/MyTasks/php/carregaTarefas.php',
			type: 'POST',
			data:{ userId: userId },
			success: function(data){

				var json = $.parseJSON(data);
				
				//Monta tabela com tarefas não concluídas
				for(var i = 0; i < json.length; i++){
					if(json[i].taskStatus != 1){
						taskList.append(
							"<tr id = "+ json[i].id +">" + 
								"<td>" + json[i].taskName + "</td>" +
								"<td>" + json[i].desc + "</td>" +
								"<td>" + json[i].dataInicio + " " + json[i].horaInicio + ":" + json[i].minutoInicio + "</td>" +
								"<td>" + json[i].dataFim + " " + json[i].horaFim + ":" + json[i].minutoFim + "</td>" +
							"</tr>"
						)
					}
				}
			}
		});
	}

	//Lista todas as tarefas concluídas
	function taskListDoneLoad(){
		$.ajax({
			url: 'modules/MyTasks/php/carregaTarefas.php',
			type: 'POST',
			data:{ userId: userId },
			success: function(data){
				var json = $.parseJSON(data);
				
				//Monta tabela com tarefas concluídas
				for(var i = 0; i < json.length; i++){
					if(json[i].taskStatus == 1){
						taskList.append(
							"<tr id = "+ json[i].id +" class = 'done'>" + 
								"<td>" + json[i].taskName + "</td>" +
								"<td>" + json[i].desc + "</td>" +
								"<td>" + json[i].dataInicio + " " + json[i].horaInicio + ":" + json[i].minutoInicio + "</td>" +
								"<td>" + json[i].dataFim + " " + json[i].horaFim + ":" + json[i].minutoFim + "</td>" +
							"</tr>"
						)
					}
				}
			}
		});
	}
	
	//Muda cor da linha dependendo do status da tarefa
	$('.taskList').on('click', 'tr:not(:first-child)', function () {

		if($(this).hasClass("highlighted")){
			//Se a tarefa já estiver selecionada a classe 'highlithed' é removida
			$(this).removeClass('highlighted');
		} else if($(this).hasClass("done")) {
			//Se a tarefa estiver concluída e não estiver selecionada é adicinada a classe 'highligthed2'
			$(this).removeClass('done');
			$(this).addClass('highlighted2');
		} else if($(this).hasClass("highlighted2")) {
			//Se a tarefa estiver concluída e já estiver selecionada é adicinada a classe 'done'
			$(this).removeClass('highlighted2');
			$(this).addClass('done');
		} else {
			//Caso a tarefa seja do tipo 'não concluída' e já esteja selecionada, é adicionado a classe 'highlited'
			$(this).addClass('highlighted');
		}
	});

	//Remove tarefas selecionadas
	$('#removeTask').on('click', function(){
		var i = 0;
		//Cria array para armazenar tarefas selecionadas
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted, .highlighted2').each(function(){
			
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
					//Se o usuário clicar em 'Sim', as tarefas selecionadas serão excluidas do banco
					"Sim": function() {
						var i = 0;

						//Cria array para armazenar o id das tarefas
						var tasks = [];

						//Para cada tarefa selecionada é armazenado o id no array
						$('.highlighted, .highlighted2').each(function(){
							
							//Remove da lista
							$(this).remove();
							
							//Guarda itens selecionados em um array
							tasks[i] = $(this).attr('id');

							i++;
						});

						//Remove do banco
						$.ajax({
							type: 'POST',
							url: 'modules/MyTasks/php/deletaTarefas.php',
							data: { tasks: tasks },
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

	//Adiciona tarefa
	$('#btnAddTask').on('click', function(){
		//Armazena valores dos campos
		var taskId = $('input[name=taskId]').val();
		var taskName = $('input[name=txtTaskName]').val();
		var taskDesc = $('textarea[name=txtTaskDesc]').val();
		var dataInicio = $('#dataInicio').val();
		var dataFim = $('#dataFim').val();

		//Hora e minuto
		var horaInicio = $('#horaInicio').val();
		var minutoInicio = $('#minutoInicio').val();
		var horaFim = $('#horaFim').val();
		var minutoFim = $('#minutoFim').val();

		//Valida se o campo com o nome da tarefa esta vazio
		if(taskName == ''){
			alert("Favor informe o nome da tarefa.");
		} else {
			//Caso o formulário seja valido, o mesmo é enviado
			$.ajax({
				type: 'POST',
				url: 'modules/MyTasks/php/addTask.php',
				data:{
					taskId: taskId,
					taskName: taskName,
					taskDesc: taskDesc,
					dataInicio: dataInicio,
					dataFim: dataFim,
					horaInicio: horaInicio,
					minutoInicio: minutoInicio,
					horaFim: horaFim,
					minutoFim: minutoFim,
					userId: userId
				},
				success: function(data){
					//Fecha dialog para adição de tarefa
					$( "#addTaskForm" ).dialog( "destroy" );

					//Limpa tarefas já existentes na tabela
					$('#taskList tr').not(':first-child').empty();
				}
			}).done(function(data){
					var json = $.parseJSON(data);

					//Adiciona marcador para informar a visão atual
					//Sempre que uma tarefa for adicionada a visão ativa será das tarefas não concluídas
					$('#typeDone').removeClass('activeTaskTypeDone');
					$('#typeUndone').addClass('activeTaskTypeUndone');

					//Mostra botão para marcar tarefa como concluída
					$('#doneTask').show();
					
					//Após o término da função, as tarefas são carregadas novamente
					//atualizando a tabela com as tarefas
					for(var i = 0; i < json.length; i++){
						if(json[i].taskStatus != 1){
							taskList.append(
								"<tr id = "+ json[i].id +">" + 
									"<td>" + json[i].taskName + "</td>" +
									"<td>" + json[i].desc + "</td>" +
									"<td>" + json[i].dataInicio + " " + json[i].horaInicio + ":" + json[i].minutoInicio + "</td>" +
									"<td>" + json[i].dataFim + " " + json[i].horaFim + ":" + json[i].minutoFim + "</td>" +
								"</tr>"
							)
						}
					}
			});
		}
		
	});

    //Carrega dados da tarefa para edição
    $('#taskList').on('dblclick', 'tr', function(){
    	//Campos do formulário
    	var taskId = $(this).attr('id');
    	var hidenId = $('input[name=taskId]');
    	var taskName = $('#txtTaskName');
		var taskDesc = $('#txtTaskDesc');
		var dataInicio = $('#dataInicio');
		var dataFim = $('#dataFim');
		
		//Hora e minuto
		var horaInicio = $('#horaInicio');
		var minutoInicio = $('#minutoInicio');
		var horaFim = $('#horaFim');
		var minutoFim = $('#minutoFim');
    	
    	//Envia id da tarefa
    	$.ajax({
    		url: 'modules/MyTasks/php/editaTarefa.php',
    		type: 'POST',
    		data:{ taskId: taskId },
    		success: function(data){
    			var task = $.parseJSON(data);

    			//Altera texto do botão
    			$('#btnAddTask span').html('Gravar');

    			//Exibe modal preenchido
				$( "#addTaskForm" ).dialog({
					modal: true,
					show: { effect: "slideDown", duration: 600 } ,
					width: 500,
				});

				//Preenche modal com as informações retornadas
    			for(var i = 0; i < task.length; i++){
    				hidenId.val(task[i].id);
    				taskName.val(task[i].taskName);
    				taskDesc.val(task[i].desc);
    				dataInicio.val(task[i].dataInicio);
    				dataFim.val(task[i].dataFim);

    				horaInicio.val(task[i].horaInicio);
    				minutoInicio.val(task[i].minutoInicio);
    				horaFim.val(task[i].horaFim);
    				minutoFim.val(task[i].minutoFim);
    			}
    		}
    	});

    });

    //Popula Hora
    $('#horaInicio, #horaFim').append(function(){
    	var i = 1;

    	for(i = 1; i <= 24; i++){
    		if(i <= 9){
    			$(this).append("<option>" + "0" + i +"</option>")
    		} else {
    			$(this).append("<option>" + i +"</option>")
    		}
    	}
    });

    //Popula Minuto
	$('#minutoInicio, #minutoFim').append(function(){
    	var i = 0;

    	for(i = 0; i <= 59; i++){
    		if(i < 10) {
    			$(this).append("<option>"+ "0" + i +"</option>")
    		} else {
    			$(this).append("<option>"+ i +"</option>")
    		}
    	}
    });

	//Marca tarefa como concluída
	$('#doneTask').on('click', function(){
		var i = 0;

		//Array para armazenar tarefas selecionadas
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		//Caso haja algum item selecionado
		if(checkSelected.length > 0){
			$( "#doneDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					//Se o usuário pressionar 'Sim'
					"Sim": function() {
						var i = 0;

						//Cria array para armazenar tarefas
						var tasks = [];

						//Para cada tarefa não concluída selecionada
						$('.highlighted').each(function(){
							
							//Guarda itens selecionados em um array
							tasks[i] = $(this).attr('id');

							//Altera cor da  tarefa para identificar que a mesma foi marcada
							//como concluida
							$(this).removeClass('highlighted');
							$(this).css('background', '#00CC00');
							$(this).addClass('done');

							i++;
						});

						//Flaga no banco como concluída
						$.ajax({
							type: 'POST',
							url: 'modules/MyTasks/php/doneTask.php',
							data: { tasks: tasks },
							success: function(data){
								//Limpa a tabela de tarefas não concluídas
								$('#taskList tr').not(':first-child').empty();

								//Atualiza tabela de tarefas não concluidas
								taskListLoad();
							}
						});

						$( this ).dialog( "close" );
					},
					Cancelar: function() {
						//Limpa a tabela de tarefas não concluídas
						$('#taskList tr').not(':first-child').empty();
						
						//Carrega tarefas não concluidas
						taskListLoad();

						$( this ).dialog( "close" );
					}
				}
			});
		}		
	});	

	//Lista tarefas concluídas
	$('#listDoneTasks').on('click', function(){
		//Esconde tarefas
		taskList.hide();

		//Esconde botão para marcar tarefa como concluída
		$('#doneTask').hide();

		//Adiciona marcador para informar a visão atual
		$('#typeDone').addClass('activeTaskTypeDone');
		$('#typeUndone').removeClass('activeTaskTypeUndone');

		//Limpa tabela de tarefas
		$('#taskList tr').not(':first-child').remove();

		//Carrega tarefas concluidas
		taskListDoneLoad();
	});

	//Lista tarefas ativas
	$('#listActiveTasks').on('click', function(){
		//Esconde tarefas
		taskList.hide();

		//Mostra botão para marcar tarefa como concluída
		$('#doneTask').show();

		//Adiciona marcador para informar a visão atual
		$('#typeDone').removeClass('activeTaskTypeDone');
		$('#typeUndone').addClass('activeTaskTypeUndone');
	
		//Limpa tabela de tarefas
		$('#taskList tr').not(':first-child').remove();

		//Carrega tarefas não concluidas
		taskListLoad();
	});	
});