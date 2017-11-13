<?php
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
     session_destroy();
     header("Location: principal.php");
  }

?>

<!-- MAL É CARREGADO A PAGINA VAI VER QUAIS SAO OS EVENTOS QUE EXISTEM NA BD -->
<?php
require_once('php/calendario/bdd.php');


$sql = "SELECT id, title, start, fim, color FROM events where color='#614051'";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Metaveiro APP" content="">

    <title>Metaveiro</title>
<link rel="icon" href="img/meta.png">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/bootstrap-select.css">
    
    <!-- Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   
    
    
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
	<link href='css/meta2.css' rel='stylesheet' />

</head>

<body>
    
    <!-- nav é a parte superior da pagina (navigation bar) -->
     <?php
    include("nav.php");
?>  
    

      <!-- é aqui posto todo o conteudo que é mostrado na pagina  -->
<div style="margin-top: 50px;">
  <div id='wrap'>
   <div  class="hide-on-small-only">
		<div id='external-events'>
              <!-- devia ir buscar automaticamente a base de dados Eticadata onde o funcionario esta no ativo-->
			<h4>Técnicos</h4>
			<label class='fc-event' onclick="verporFunc('tec01 #008000')"  id="tec01" style="background-color:#008000;  text-align:center;">Armando Batista</label>
			<label class='fc-event'  onclick="verporFunc('tec02 #FFD700')" id="tec02" style="background-color:#FFD700; color: black;text-align:center;">Rui Silva</label>
			<label class='fc-event'  onclick="verporFunc('tec03 #FF0000')" id="tec03" style="background-color:#FF0000; text-align:center;">Rui Pedro</label>
			<label class='fc-event' onclick="verporFunc('tec04 #8E35EF')" id="tec04" style="background-color:#8E35EF; text-align:center;">Paulo Santos</label>
			<label class='fc-event' onclick="verporFunc('tec05 #E8ADAA')"  id="tec05" style="background-color:#E8ADAA; color: black;text-align:center;">Márcio Bento</label>
			<label class='fc-event'  onclick="verporFunc('tec06 #008080')" id="tec06"style="background-color:#008080; text-align:center;">Luís Figueiral</label>
			<label class='fc-event'  onclick="verporFunc('tec07 #F535AA')" id="tec07" style="background-color:#F535AA; color: black;text-align:center;">Joaquim Carvalho</label>
			<label class='fc-event'  onclick="verporFunc('tec08 #614051')" id="tec08" style="background-color:#614051; text-align:center;">João Monteiro</label>
			<label class='fc-event'  onclick="verporFunc('tec09 #43C6DB')" id="tec09" style="background-color:#43C6DB; color: black;text-align:center;">Celso Ribeiro</label>			
			<label class='fc-event'  onclick="verporFunc('tec10 #00FF00')" id="tec10"style="background-color:#00FF00; color: black;text-align:center;">Filipe Abrantes</label>	
			<label class='fc-event'   onclick="verporFunc('tec11 #000000')"id="tec11" style="background-color:#000000; color: white;text-align:center;">Carlos Girão</label>
             <label class='fc-event'   onclick="verporFunc('tec13 #808080')"id="tec13" style="background-color:#808080; color: white;text-align:center;">Fernando Tojal</label>	
              <label class='fc-event'   onclick="verporFunc('tec14 #ff6600')"id="tec14" style="background-color:#ff6600; color: white;text-align:center;">Carlos Martins</label>	
			<label class='fc-event'  onclick="verporFunc('tec12 #FFFFFF')"id="tec12"  style="background-color:#FFFFFF; color: black;text-align:center;">TODOS</label>			
		</div>
		</div>
 
        <!-- é posto aqui o coalendario todo -->
		<div id='calendar'></div>

		<div style='clear:both'></div>

	</div>
      <!-- *************************************************************** -->
    
       
        <!-- /.row -->
		
		<!-- Modal para Criar novo evento-->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
                
			<form class="form-horizontal" method="POST" action="php/calendario/addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Tarefa</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Obra</label>
                    <div class="col-sm-10">
                    <select name="title" id="title" class="selectpicker" data-hide-disabled="true" data-live-search="true">
                             <option disabled selected>Obra</option>
                            <!-- é buscado todas as obras abertas até ao momento no eticadata, as que nao estao concluidas -->
                            <?php include 'php/Calendario/pesquisa.php';?> 
                    </select>
					</div>
                      
				  </div>
				  <div class="form-group">
                      <!-- -->
					<label for="color" class="col-sm-2 control-label">Técnico 1</label>
					<div class="col-sm-10">
                        <select name="color" id="color" class="selectpicker" data-hide-disabled="true" data-live-search="true">
						  <option >Técnico</option>
						  <option style="color:#008000;" value="#008000">&#9724; Armando Batista</option>
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Rui Silva</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rui Pedro</option>
						  <option style="color:#8E35EF;" value="#8E35EF">&#9724; Paulo Santos</option>
						  <option style="color:#E8ADAA;" value="#E8ADAA">&#9724; Márcio Bento</option>
						  <option style="color:#008080;" value="#008080">&#9724; Luís Figueiral</option>
						  <option style="color:#F535AA;" value="#F535AA">&#9724; Joaquim Carvalho</option>
						  <option style="color:#614051;" value="#614051">&#9724; João Monteiro</option>
						  <option style="color:#43C6DB;" value="#43C6DB">&#9724; Celso Ribeiro</option>
						  <option style="color:#00FF00;" value="#00FF00">&#9724; Filipe Abrantes</option>
						  <option style="color:#000000;" value="#000000">&#9724; Carlos Girão</option>
						  <option style="color:#808080;" value="#808080">&#9724; Fernando Tojal</option>
						  <option style="color:#ff6600;" value="#ff6600">&#9724; Carlos Martins</option>
						</select>
                          <a class="btn-floating btn-small waves-effect waves-light red" id="btnEsc"><i class="material-icons">add</i></a>
					</div>
                    
				  </div>
                  <!-- tem a possibilidade de introduzir mais do que um tecnico para cada obra -->
                  <span id="esconder">
                          <div class="form-group">
                            <label for="tecnico2" class="col-sm-2 control-label">Técnico 2</label>
                            <div class="col-sm-10">
                                <select name="tecnico2" id="tecnico2" class="selectpicker" data-hide-disabled="true" data-live-search="true">
                                  <option >Técnico</option>
                                <option style="color:#008000;" value="#008000">&#9724; Armando Batista</option>
                                  <option style="color:#FFD700;" value="#FFD700">&#9724; Rui Silva</option>
                                  <option style="color:#FF0000;" value="#FF0000">&#9724; Rui Pedro</option>
                                  <option style="color:#8E35EF;" value="#8E35EF">&#9724; Paulo Santos</option>
                                  <option style="color:#E8ADAA;" value="#E8ADAA">&#9724; Márcio Bento</option>
                                  <option style="color:#008080;" value="#008080">&#9724; Luís Figueiral</option>
                                  <option style="color:#F535AA;" value="#F535AA">&#9724; Joaquim Carvalho</option>
                                  <option style="color:#614051;" value="#614051">&#9724; João Monteiro</option>
                                  <option style="color:#43C6DB;" value="#43C6DB">&#9724; Celso Ribeiro</option>
                                  <option style="color:#00FF00;" value="#00FF00">&#9724; Filipe Abrantes</option>
                                  <option style="color:#000000;" value="#000000">&#9724; Carlos Girão</option>
                                      <option style="color:#808080;" value="#808080">&#9724; Fernando Tojal</option>
                                      <option style="color:#ff6600;" value="#ff6600">&#9724; Carlos Martins</option>
                                </select>
                            </div>
                          </div>  <div class="form-group">
                            <label for="tecnico2" class="col-sm-2 control-label">Técnico 3</label>
                            <div class="col-sm-10">
                                <select name="tecnico3" id="tecnico3" class="selectpicker" data-hide-disabled="true" data-live-search="true">
                                  <option >Técnico</option>
                                  <option style="color:#008000;" value="#008000">&#9724; Armando Batista</option>
                                  <option style="color:#FFD700;" value="#FFD700">&#9724; Rui Silva</option>
                                  <option style="color:#FF0000;" value="#FF0000">&#9724; Rui Pedro</option>
                                  <option style="color:#8E35EF;" value="#8E35EF">&#9724; Paulo Santos</option>
                                  <option style="color:#E8ADAA;" value="#E8ADAA">&#9724; Márcio Bento</option>
                                  <option style="color:#008080;" value="#008080">&#9724; Luís Figueiral</option>
                                  <option style="color:#F535AA;" value="#F535AA">&#9724; Joaquim Carvalho</option>
                                  <option style="color:#614051;" value="#614051">&#9724; João Monteiro</option>
                                  <option style="color:#43C6DB;" value="#43C6DB">&#9724; Celso Ribeiro</option>
                                  <option style="color:#00FF00;" value="#00FF00">&#9724; Filipe Abrantes</option>
                                  <option style="color:#000000;" value="#000000">&#9724; Carlos Girão</option>
                                      <option style="color:#808080;" value="#808080">&#9724; Fernando Tojal</option>
                                      <option style="color:#ff6600;" value="#ff6600">&#9724; Carlos Martins</option>
                                </select>
                            </div>
                          </div>  <div class="form-group">
                            <label for="tecnico4" class="col-sm-2 control-label">Técnico 4</label>
                            <div class="col-sm-10">
                                <select name="tecnico4" id="tecnico4" class="selectpicker" data-hide-disabled="true" data-live-search="true">
                                  <option >Técnico</option>
                                  <option style="color:#008000;" value="#008000">&#9724; Armando Batista</option>
                                  <option style="color:#FFD700;" value="#FFD700">&#9724; Rui Silva</option>
                                  <option style="color:#FF0000;" value="#FF0000">&#9724; Rui Pedro</option>
                                  <option style="color:#8E35EF;" value="#8E35EF">&#9724; Paulo Santos</option>
                                  <option style="color:#E8ADAA;" value="#E8ADAA">&#9724; Márcio Bento</option>
                                  <option style="color:#008080;" value="#008080">&#9724; Luís Figueiral</option>
                                  <option style="color:#F535AA;" value="#F535AA">&#9724; Joaquim Carvalho</option>
                                  <option style="color:#614051;" value="#614051">&#9724; João Monteiro</option>
                                  <option style="color:#43C6DB;" value="#43C6DB">&#9724; Celso Ribeiro</option>
                                  <option style="color:#00FF00;" value="#00FF00">&#9724; Filipe Abrantes</option>
                                  <option style="color:#000000;" value="#000000">&#9724; Carlos Girão</option>
                                      <option style="color:#808080;" value="#808080">&#9724; Fernando Tojal</option>
                                      <option style="color:#ff6600;" value="#ff6600">&#9724; Carlos Martins</option>
                                </select>
                            </div>
                          </div>
                  </span>
               
                   <!-- datas para o start e end da tarefa fullcalendar-->
				   <div class="form-group hide">
					<label for="start" class="col-sm-2 control-label ">Data de inicio</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group hide">
					<label for="end" class="col-sm-2 control-label">Data de fim</label>
					<div class="col-sm-10">
					  <input type="text" name="fim" class="form-control" id="fim" readonly>
					</div>
				  </div>
                  
                   <!-- é depois aqui chamdo o resto dos detalhes da guia-->
                  <div id="detalhesGuia"></div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
    
        <!-- este form é criado isoladamente pois serve para alterar a avaria, mas como o submit esta dentro de outro
        form pus ent aqui e digo que cada elemnto que eu quero pertence a este form (alteraravaria)-->
		<form id="alteraravaria"  method="POST" action="php/Calendario/alterarAvaria.php"></form>
		
		<!-- ***********************************************Modal  Editar evento ***************************************************************** -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="php/Calendario/editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Tarefa</h4>
			  </div>
			  <div class="modal-body">
				
				<div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Obra</label>
                    <div class="col-sm-10">
                    <select name="title2" class="form-control" id="title2">
                        <option value="" disabled selected>Escolha uma das seguintes:</option>
                        <!-- este vai buscar a um sitio diferente do criar pois depois de as obras estarem 
                        concluidas ja nao conseguimos ver qual é a obra nem os detalhes, assim  ja 
                        conseguimos pois nao tem o filtro do concluido-->
                            <?php include 'php/Calendario/pesquisaeditar.php';?> 
                    </select>
                        
					</div>
              </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Técnico</label>
					<div class="col-sm-10">
                        
                        
                        
					  <select name="color" class="form-control" id="color">
                          <option value="">Técnico</option>
				          <option style="color:#008000;" value="#008000">&#9724; Armando Batista</option>
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Rui Silva</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Rui Pedro</option>
						  <option style="color:#8E35EF;" value="#8E35EF">&#9724; Paulo Santos</option>
						  <option style="color:#E8ADAA;" value="#E8ADAA">&#9724; Márcio Bento</option>
						  <option style="color:#008080;" value="#008080">&#9724; Luís Figueiral</option>
						  <option style="color:#F535AA;" value="#F535AA">&#9724; Joaquim Carvalho</option>
						  <option style="color:#614051;" value="#614051">&#9724; João Monteiro</option>
						  <option style="color:#43C6DB;" value="#43C6DB">&#9724; Celso Ribeiro</option>
						  <option style="color:#00FF00;" value="#00FF00">&#9724; Filipe Abrantes</option>
						  <option style="color:#000000;" value="#000000">&#9724; Carlos Girão</option>
                            <option style="color:#808080;" value="#808080">&#9724; Fernando Tojal</option>
                            <option style="color:#ff6600;" value="#ff6600">&#9724; Carlos Martins</option>
						</select>
					</div>
                      
				  </div>
                  <!-- é posto aqui todos os detalhes da guia dois (editar)-->
                  <div id="detalhesGuia2"></div>
                  
                  <!-- ************************* para editar a avaria *************************** -->
                  <!-- é posto aqui em cda input o form a que este se dedica para depois no php conseguir
                    fazer o post de cada um -->
                     <input type="text" id="textoAvaria" name="textoAvaria" style="display:none;" form="alteraravaria">
                     <a name="editar" id="editar" style="float:right; cursor: pointer;">Editar Descrição Avaria</a> 
                 
                    <input type="text" id="nmr" name="nmr" class="hide" form="alteraravaria">   
				    
                  <!-- ******************************************************************************-->
                  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
                               
							   <input type="checkbox"  name="delete" id="delete">
                              <label class="text-danger" for="delete"> Apagar tarefa</label>
                              
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
                <div  class="hide-on-small-only">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Guardar Alterações</button>
                </div>
                   <div  class="hide-on-med-and-up	">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                       <br>
                       <br>
                    <button type="submit" class="btn btn-primary">Guardar Alterações</button>
                  </div>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.custom.min.js"></script>
	

  
    
    
    
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	<script src='js/lang-all.js'></script>
    <script src="js/meta.js"></script> 
	<script>
    
    $(document).ready(function() {
		
      // ver a data atual  
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth()+1)+"";if(twoDigitMonth.length==1)	twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1)	twoDigitDate="0" +twoDigitDate;
    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;
         
        $('#esconder').css('display', 'none');
        
         //Para Ficar em português
        var currentLangCode = 'pt';
        // build the language selector's options
		$.each($.fullCalendar.langs, function(langCode) {
			$('#lang-selector').append(
				$('<option/>')
					.attr('value', langCode)
					.prop('selected', langCode == currentLangCode)
					.text(langCode)
			);
		});

        $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
            defaultDate: currentDate,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
            lang: currentLangCode,
            businessHours: true, // display business hours
			select: function(start, end) {
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD 09:mm:ss'));
				$('#ModalAdd #fim').val(moment(start).format('YYYY-MM-DD 18:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title2').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position
              
				edit(event);
                
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
				edit(event);
			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['fim']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['fim'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			],
            windowResize: function(view) {
            if ($(window).width() < 514){
                $('#calendar').fullCalendar( 'changeView', 'month' );
            } else {
                $('#calendar').fullCalendar( 'changeView', 'month' );
            }
            }
		});
       
		function edit(event){
             var idPessoa= <?php echo $_SESSION["id"] ?>;
             if( idPessoa != '99'){ //limitar para já a isabel
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'php/Calendario/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep != 'OK'){
						alert('Não foi possivel guardar.'); 
					}
				}
			});
		}
		}
		
       
        
	});
        
        /* para o botao de adicinar mais funcionarios a uma tarefa */
        $('#btnEsc').click(function(){
           $('#esconder').css('display', 'block');
         
        });
        
        
        /* funcao para editar a avaria*/
        $('#editar').click(function(){ 
            
            
            $('#nmr').val($("#title2").val().substring(0, 6)); 
             if($("#editar").text()!="Guardar"){
                 $('#avaria').css('display', 'none');
                 $('#textoAvaria').val($('#avaria').text());
                 $('#textoAvaria').css('display', 'block');      
                 $("#editar").text("Guardar");    
                
            }
            else{
                   $('#avaria').text($('#textoAvaria').val()); 
                   $('#avaria').css('display', 'block');   
                   $('#textoAvaria').css('display', 'none'); 
                   $("#editar").text("Editar Descrição Avaria");    
                   $("#alteraravaria").submit();
            }
        });
        
      //quando o titulo2 (titulo do criar nova) muda os dados sao alterados
       $('#title').change(function() {
                $.ajax({
                    url:'php/Calendario/detalhesGuia.php?nmr='+$(this).val().substring(0, 6),
                    complete: function (response) {
                        $('#detalhesGuia').html(response.responseText);
                    },
                    error: function () {
                        $('#detalhesGuia').html('Bummer: there was an error!');
                    }
                });
            });
        //quando o modal de editar abre este vai logo ler o texto 
        //que esta na select e faz a pesquisa por este.
       $( "#ModalEdit" ).on('shown.bs.modal', function(){
           var nmr = $("[name=title2] option:selected").text().substring(0, 6);
           
           //para quando mudar de tarefa (editar) o texto da avaria nao apareca e que o botao editar esteja nao como
           //guardar mas sim como editar... .
           $('#textoAvaria').css('display', 'none');
           $("#editar").text("Editar Descrição Avaria");    
           
                $.ajax({
                    url:'php/Calendario/detalhesGuia.php?nmr='+nmr,
                    complete: function (response) {
                        $('#detalhesGuia2').html(response.responseText);
                    },
                    error: function () {
                        $('#detalhesGuia2').html('Bummer: there was an error!');
                    }
                });
             
        });
        //quando o titulo2 (titulo do editar) muda os dados sao alterados
        $('#title2').change(function() {
                $.ajax({
                    url:'php/Calendario/detalhesGuia.php?nmr='+$(this).val().substring(0, 6),
                    complete: function (response) {
                        $('#detalhesGuia2').html(response.responseText);
                    },
                    error: function () {
                        $('#detalhesGuia2').html('Bummer: there was an error!');
                    }
                });
            });
        
        function verporFunc(param){
            
            var id= param.substring(0, 5);
            var cor= param.substring(6);
            if(id!="tec12"){
           
          window.location.replace("calendario"+id+".php");
            }
            else{
                window.location.replace("calendario.php");
            }
        }
     
    </script>

    
	 <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>

    
    
  
  <script src="js/bootstrap-select.js"></script>
    
    <!-- para o select personalizado do modal criar tarefa-->
    <script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
    
    
    
</body>

</html>
