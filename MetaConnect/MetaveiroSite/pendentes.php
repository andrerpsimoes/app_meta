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
     <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/table.css" type="text/css" rel="stylesheet" />
    
</head>
<body>
     <?php
        include("nav.php");  
     ?>  
    
    <h3 class="center-align"> Assistências </h3>  
    
   
      <div id="table-wrapper">
         <div id="table-scroll">
      
       <!--responsive-table -->
       <table id="tabela">
            <thead >
                <tr>
                    <th  data-field="numero" >Numero</th>
                    <th  data-field="nome">Nome Cliente</th>
                    <th   data-field="zona">Zona Obra</th>
                    <th   data-field="avaria">Natureza Avaria</th>
                </tr>
            </thead>
                <tbody>
                    <?php include 'php/contabilidade/cont.php';?>
                </tbody>      


        </table>
       </div>
    </div> 
    	<!-- Modal ver e editar assistencia-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
                
                <form class="form-horizontal" >
			
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 
                  <div id="contDetalhe" name="contDetalhe">
                  
               
                  </div>
                  
                  
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>    
        

    
    
       
    
  <!-- SCRIPTS -->

      <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.custom.min.js"></script>
	
     
    <script>
     $(document).ready(function(){
          $('select').material_select();

         $('#tabela').find('tr').click( function(){
             
             var nmr=$(this).find('td').first().text();
             
             
             $.ajax({
                    url:'php/contDetalhe.php?nmr='+nmr,
                    complete: function (response) {
                        $('#contDetalhe').html(response.responseText);
                     
                    },
                    error: function () {
                        $('#contDetalhe').html('Não foi possivel contactar o servidor');
                    }
                });  
            });
     
     
         
    
     });
    </script>
	
     <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>
    </body>
  
</html>