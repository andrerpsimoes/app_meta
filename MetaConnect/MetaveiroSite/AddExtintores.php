<?php
include("restrito.php");

  if (isset($_GET['logout'])) {
     session_destroy();
     header("Refresh:0");
  }

?>
<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Carlos Girão" content="">
    <title>Metaveiro</title>
    
    <link rel="icon" href="img/meta.png">
    <link rel="stylesheet" href="css/meta.css"> 
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
     <!-- Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materializee.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   
</head>
<body>
    
      <!-- nav é a parte superior da pagina (navigation bar) -->
     <?php
    include("nav.php");
     ?>  
    
    
    <h3 class="center-align "> Pesquisas </h3>    
   
          
        <div class="row">
           
            <div class="input-field col s12 m6 l6">
            <select id="pesquisa">
              <option value="" disabled selected>-------------</option>
              <option value="extintores">Extintores</option>
              <option value="relogioponto">Relogio de ponto</option>
              <option value="controloacesso">Controlos de acesso</option>
              <option value="fotocopiadoras">Fotocopiadoras</option>
              <option value="incendio">Incendio</option>
              <option value="alarmes">Alarmes</option>
              <option value="eticadata">Eticadata</option>
            </select>
            <label>Pesquisar por</label>
          </div>
           
           
            <div class="input-field col s12 m6 l6">
              <i class="material-icons prefix"  >perm_identity</i>
              <input  name="codartigo" id="codartigo" type="text"  class="validate" >
              <label for="codartigo" >Artigo (código)</label>
            </div>
            
            <div class="input-field col s12 m6 l6">
              <i class="material-icons prefix"  >perm_identity</i>
              <input  name="codcliente" id="codcliente" type="text"  class="validate" >
              <label for="codcliente" >Cliente (código)</label>
            </div>
            
            <div class="input-field col s12 m12 l4">
              <i class="material-icons prefix">today</i>
              <input name="datainicio" id="datainicio"  type="date" class="datepicker" >
               <label for="datainicio" >Data inicial</label>
            </div>
            
            <div class="input-field col s12 m12 l4">
              <i class="material-icons prefix">today</i>
              <input name="datafim" id="datafim"  type="date" class="datepicker" >
              <label for="datafim" >Data fim</label>
            </div>
            
            
        </div>
          <input type="button" id="pesquisar" value="pesquisar">
        
        <div id="tabelaPesquisa">
            
            
        </div>

   
 
    
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
          

   
      
 
    <script>
        
        
        
        
     $(document).ready(function(){
         
         
          $('select').material_select();
        
            $('.datepicker').pickadate({
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Fechar',
            labelMonthNext: 'Próximo mês',
            labelMonthPrev: 'Mês anterior',
            labelMonthSelect: 'Selecione um mês',
            labelYearSelect: 'Selecione um ano',
            selectMonths: true, 
            selectYears: 15,
            format: 'yyyy/mm/dd',
            });
      
     });
        
        
        $('#pesquisar').click(function(){
            var codartigo= $("#codartigo").val(),
                codcliente= $("#codcliente").val(),
                datainicio= $("#datainicio").val(),
                datafim= $("#datafim").val(),
                pesquisarpor= $( "#pesquisa option:selected" ).val();
            
      
               $.ajax({
                     url: 'php/geral/tabelapesquisaartigo.php',
                     type: "POST",
                     data: {
                         codartigo:codartigo,
                         codcliente: codcliente,
                         datainicio: datainicio,
                         datafim: datafim,
                         pesquisarpor: pesquisarpor
                     },
                     success: function(rep) {
                           $("#tabelaPesquisa").html(rep);
                        }
                    });
        
        });
        
        
        
      $(document).on('click', '.detalhes', function(e) {
         // para os detalhes da fatura 
          
      });
        
    </script>
    
         

   
    </body>
  
</html>