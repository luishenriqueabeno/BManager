$(document).ready(function(){

	/***************************
	* Variaveis de inicialização 
	****************************/
	var taskList = $('#taskList');
	var dataInicio = $('#dataInicio').val();
	var dataFim = $('#dataFim').val();
	var userId = $('input[name=userId]').val();

	//Esconde dialog no carregamento
	$('#deleteDialog').hide();
	$('#deleteDialogSelected').hide();
	$('#doneDialog').hide();

	//Esconde modal no carregamento do documento
	$('#addTaskForm').hide();
	$('#addGroupForm').hide();

	//Date picker
    $( "#dataInicio" ).datepicker({
    	altFormat: "dd/mm/yyy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    $( "#dataFim" ).datepicker({
    	altFormat: "dd/mm/yy",
    	dateFormat: "dd/mm/yy",
    	showOtherMonths: true,
      	selectOtherMonths: true,
      	changeMonth: true,
      	changeYear: true
    });

    /***************************
	* Inicio das funções 
	****************************/

	//Lista todas as tarefas
	$.ajax({
		url: 'modules/MyTasks/php/carregaTarefas.php',
		type: 'POST',
		data:{ userId: userId },
		success: function(data){
			var json = $.parseJSON(data);
			
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
				} else {
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

	//Muda cor da linha dependendo do status da tarefa
	$('.taskList').on('click', 'tr:not(:first-child)', function () {
		if($(this).hasClass("highlighted")){
			$(this).removeClass('highlighted');
		} else if($(this).hasClass("done")) {
			$(this).removeClass('done');
			$(this).addClass('highlighted2');
		} else if($(this).hasClass("highlighted2")) {
			$(this).removeClass('highlighted2');
			$(this).addClass('done')
		} else {
			$(this).addClass('highlighted');
		}	
	});

	//Remove tarefas selecionadas
	$('#removeTask').on('click', function(){
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
					"Apagar?": function() {
						var i = 0;
						var tasks = [];

						$('.highlighted').each(function(){
							
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

	//Abre modal para adicionar tarefa
	$('#addTask').on('click', function(){
		$('#btnAddTask span').html('Adicionar');
		$('input[name=taskId]').val('');

		clearFields();

		//Exibe modal
		$( "#addTaskForm" ).dialog({
			modal: true,
			show: { effect: "slideDown", duration: 600 } ,
			width: 500,
			//height: 500
		});

	});

	//Adiciona tarefa
	$('#btnAddTask').on('click', function(){
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

		if(taskName == ''){
			alert("Favor informe o nome da tarefa.");
		} else {
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
					//location.reload();
					$( "#addTaskForm" ).dialog( "destroy" );
					$('#taskList tr').not(':first-child').empty();
				}
			}).done(function(data){
					var json = $.parseJSON(data);
			
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
						} else {
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

	//Botão cancelar do formulário
	$('#btnCancelTaskForm').on('click', function(){
		$( "#addTaskForm" ).dialog( "destroy" );
	});

    //Carrega dados da tarefa para edição
    $('#taskList').on('dblclick', 'tr', function(){
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
    	
    	$.ajax({
    		url: 'modules/MyTasks/php/editaTarefa.php',
    		type: 'POST',
    		data:{ taskId: taskId },
    		success: function(data){
    			var task = $.parseJSON(data);

    			$('#btnAddTask span').html('Gravar');

    			//Exibe modal preenchido
				$( "#addTaskForm" ).dialog({
					modal: true,
					show: { effect: "slideDown", duration: 600 } ,
					width: 500,
				});

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

	//Limpa campos
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

	//Marca tarefa como concluída
	$('#doneTask').on('click', function(){
		var i = 0;
		var checkSelected = [];

		//Verifica se tem algum item selecionado
		$('.highlighted').each(function(){
			
			//Guarda itens selecionados em um array
			checkSelected[i] = $(this).attr('id');

			i++;
		});

		if(checkSelected.length > 0){
			$( "#doneDialog" ).dialog({
				resizable: false,
				height:140,
				width:500,
				modal: true,
				buttons: {
					"Marcar essa(s) tarefa(s) como concluída(s)": function() {
						var i = 0;
						var tasks = [];

						$('.highlighted').each(function(){
							
							//Guarda itens selecionados em um array
							tasks[i] = $(this).attr('id');

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
								
							}
						});

						$( this ).dialog( "close" );
					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	});
});