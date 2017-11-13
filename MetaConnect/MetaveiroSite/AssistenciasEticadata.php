<?php
include("restrito.php");


//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
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
    <meta name="Metaveiro APP" content="">

    
    <title>Metaveiro</title>
    <link rel="icon" href="img/meta.png">
     <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/table.css" type="text/css" rel="stylesheet" />
    
</head>
<body>
    
    <!-- nav é a parte superior da pagina (navigation bar) -->
     <?php
        include("nav.php");  
     ?>  
    
    <h3 class="center-align"> Assistências </h3>  
      
     
    
    <div class="row">
        <div class="input-field col s8">
          <i class="material-icons prefix">search</i>
          <input type="text" class="search form-control" >
          <label for="icon_prefix">Procurar</label>
        </div>
    </div>
        <span class="counter pull-right"></span> 
           
          
      <!--   <div id="table-scroll">-->
      
       <!--responsive-table -->
       <table id="tabela" class="table table-hover table-bordered results">
           <thead>
            <tr>
              <th class="col-md-1 col-xs-1" data-field="numero" >Numero</th>
              <th class="col-md-2 col-xs-2" data-field="nome">Nome Cliente</th>
              <th class="col-md-2 col-xs-2" data-field="nome">Morada</th>
              <th class="col-md-7 col-xs-7" data-field="avaria">Natureza Avaria</th>
              <th class="col-md-1 col-xs-1"  data-field="concluido">Concluido</th>
            </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> Sem Resultados.</td>
    </tr>
  </thead>
                <tbody>
                    <?php include 'php/assistsEticadata.php';?>
                </tbody>      


        </table>
    
  <!-- SCRIPTS -->

      <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.custom.min.js"></script>
	
     
    <script>
     $(document).ready(function(){
          $('select').material_select();

         
         
         /* PARA PROCURAR EM TODA A TABELA SEMPRE QUE DIGITA UMA TECLA NUM INPUT*/
        $(".search").keyup(function () {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

              $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
              });

              $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','false');
              });

              $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','true');
              });

              var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');

              if(jobCount == '0') {$('.no-result').show();}
                else {$('.no-result').hide();}
		  });

         /*CASO SEJA CLICADO NUMA LINHA (TR) ESTE VAI DAR POR CONCLUIDA A TAREFA 
         BUSCANDO O NUMERO DA TAREFA (1º CAMPO) ATUALIZANDO O SQL E PONDO O VISTO NO CONCLUIDO*/
           $('#tabela').find('tr').click( function(){
           
                 var nmr=$(this).find('td').first().text();
               
                var nmrc="#"+$(this).find('td').first().text();
              
                if(!$(nmrc).is(":checked")) {
                  
                         $.ajax({
                            url:'php/updateetic.php?nmr='+nmr,
                            error: function () {
                           
                            }
                        });
                       $(nmrc).prop('checked', true);
                }
                else{
                       
                             $.ajax({
                                url:'php/updateeticto0.php?nmr='+nmr,
                                error: function () {

                                }
                            });
                             $(nmrc).prop('checked', false);
                       
                    }       
            });
         
    
     });
    </script>
	
     <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>
    </body>
  
</html>