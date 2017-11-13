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

$cor=$_SESSION["cor"];

$sql = "SELECT id, title, start, fim, color FROM events where color='".$cor."' ";

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
<link rel="icon" href="img/meta.png">
    <title>Metaveiro</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    
      
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
    
    
<div style="margin-top: 50px;">
  <div id='wrap'>


		<div id='calendar'></div>

		
	</div>
    <form id="concluirTarefa"  method="POST" action="php/Calendario/concluirTarefa.php"></form>
		<!-- ***********************************************Modal evento ***************************************************************** -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<form class="form-horizontal" id="obs" name="obs" method="POST" action="php/Calendario/observacoes.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tarefa</h4>
			  </div>
			  <div class="modal-body">
				
				<div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Obra</label>
                    <div class="col-sm-10">
                    <input type="text" name="title2" class="form-control" id="title2" disabled>
                    
                      <a name="historico" id="historico" style="float:right; cursor: pointer;">Histórico Cliente</a>     
					</div>
              </div>
				 
                  
                  <div id="detalhesGuia2"></div>
                  
                  <a name="editar" id="editar" style="float:right; cursor: pointer;">Editar Observações</a>
                  <br>
                  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                      <input type="checkbox"  name="concluir" id="concluir" form="concluirTarefa">
                      <label class="text-danger" id="lblConcluida" name="lblConcluida" for="concluir">Tarefa Concluida</label>
                  </div>
                  </div>
                  </div>
                  
                  
                  <input type="text" id="nmr2" name="nmr2" form="concluirTarefa" class="hide" > 
                  <br>
                     <input type="text" id="nmrObs" name="nmrObs" class="hide" >   
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    
    
    <!-- ***********************************************Modal HISTORICO ***************************************************************** -->
		<div class="modal fade" id="modalhistorico" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<form class="form-horizontal" id="hist" name="hist">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="TituloHistorico"></h4>
			  </div>
			  <div class="modal-body">
				<div class="form-group">
                   <h5 id="cliente" name="cliente" class="center-align"></h5>
              </div>
                  
                
                        <div id="detalhesHistorico"></div>
               
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
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
		   
			eventLimit: true, // allow "more" link when too many events
		
			selectHelper: true,
            lang: currentLangCode,
            businessHours: true, // display business hours
			
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title2').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
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
                $('#calendar').fullCalendar( 'changeView', 'basicDay' );
            } else {
                $('#calendar').fullCalendar( 'changeView', 'month' );
            }
            }
		});
	});
       
        //quando o modal abre este vai logo ler o texto 
        //que esta na select e faz a pesquisa por este.
       $( "#ModalEdit" ).on('shown.bs.modal', function(){
           var nmr = $("#title2").val().substring(0, 6);
          $("#editar").text("Editar Observações");
                $.ajax({
                    url:'php/Calendario/detalhesGuia.php?nmr='+nmr,
                    complete: function (response) {
                        $('#detalhesGuia2').html(response.responseText);
                          if($('#concl').val()==1){
                            $('#concluir').prop('checked', true);
                          }
                        else{
                            $('#concluir').prop('checked', false);
                        }
                    },
                    error: function () {
                        $('#detalhesGuia2').html('Bummer: there was an error!');
                    }
                });
              $.ajax({
                    url:'php/Calendario/tecnicosParaGuia.php?nmr='+nmr,
                    complete: function (response) {
                        $('#detalhesGuia2').html($('#detalhesGuia2').html()+response.responseText);
                    },
                    error: function () {
                        $('#detalhesGuia2').html('<h6>Ocorreu um erro, contacte o administrador do sistema.</h6>');
                    }
                });
             
             
        }); 
        
       
        //para que possa editaro campo das observações
       $( "#editar" ).click(function(){
         
          $('#nmrObs').val($("#title2").val().substring(0, 6)); 
             if($("#editar").text()=="Guardar"){  
                 $("#obs").submit();
            }
            else{
                    
                $('#observacoes').prop('disabled', false);   
                $("#editar").text("Guardar");
            }
           
        }); 
        
          $( "#concluir" ).click(function(){
            
              $('#nmr2').val($("#title2").val().substring(0, 6)); 
              $("#concluirTarefa").submit();
        }); 
        
        
        
        //para que possa ver o histórico do cliente
        $( "#historico" ).click(function(){
            var nome=$("#title2").val().substring(7);
            
            $('#ModalEdit').modal('toggle');
            $('#modalhistorico').modal('toggle');
            $('#TituloHistorico').text("Histórico");
            $('#cliente').text(nome);
            $.ajax({
                    url:'php/Calendario/historico.php?nome='+encodeURIComponent(nome),
                    complete: function (response) {
                        $('#detalhesHistorico').html(response.responseText);
                      
                    },
                    error: function () {
                        $('#detalhesHistorico').html('Houve um erro. Contacte o administrador.');
                    }
                });
           
        });
        
        
        
        
        
    </script>
	 <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>

</body>

</html>
