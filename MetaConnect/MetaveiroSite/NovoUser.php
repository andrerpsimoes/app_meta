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
     <?php
        include("nav.php");
    ?>  
    
    
     <h3 class="center-align"> Novo Utilizador </h3>    
    
    <!-- **************************************************************************************************** -->
   
    <form class="col s11 "  method = "POST">
      
        <div class="row">
        <div class="input-field col s11 m11 l6 tooltipped" data-position="top" data-delay="50" data-tooltip="Nome do Funcionário">
          <i class="material-icons prefix">perm_identity</i>
          <input  name="nome" id="nome" type="text" class="validate" >
          <label for="icon_prefix">Nome</label>
        </div>
            
        <div class="input-field col s11 m11 l5 tooltipped" data-position="top" data-delay="50" data-tooltip="Username do Funcionário">
          <i class="material-icons prefix">person_pin</i>
          <input  name="user" id="user"  length="10" type="text" class="validate" >
          <label for="icon_prefix">Username</label>
        </div>
     
        
      
            <div class="input-field col s11 m11 l6 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Password do Funcionário">
              <i class="material-icons prefix">lock</i>
                 <input name="pass" id="pass" type="password" class="validate">
                 <label for="password">Password</label>
            </div> 
            <div class="input-field col s11 m11 l5 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Repetição da password">
              <i class="material-icons prefix">lock</i>
                 <input id="pass2" type="password"  class="validate">
                 <label for="password">Repetir Password</label>
            </div>
        
        
     
            <div class="input-field col s11 m11 l6 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Email do Funcionário">
                  <i class="material-icons prefix">email</i>
                  <input name="email" id="email" type="email" class="validate">
                  <label for="email" data-error="Incorreto">Email</label>
            </div>
            <div class="input-field col s11 m11 l5">
            <i class="material-icons prefix">error_outline</i>
             <select name= "tipoconta"id="tipoconta">
              <option value="" disabled selected>Tipo de Conta</option>
              <option value="1">Administrativa</option>
              <option value="2">Técnica</option>
              <option value="3">Comercial</option>
            </select>
          </div>
    
        
      
        <div id="corFunc"style="display:none;">
            <button class="btn waves-effect waves-light jscolor {valueElement:'valorcor', styleElement:'styleInput'}" style="margin-left:20%; "><i class="material-icons left">cloud</i>Cor para o Técnico</button>
            <br>
            <br>
            <div id="styleInput" style=" height:20px; "> </div>
            <!-- nome da cor para o tecnico-->
            <input type="text" name="valorcor" id="valorcor" class="hide" >
        </div>   
            
        </div>
        <br>
        <button class="btn waves-effect waves-light " type="submit" name="action" style="width:100%;" >Criar  </button>
    </form>
    
       

    
      <!-- SCRIPTS -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/jscolor.js"></script>
      
     <script type="text/javascript" src="js/meta.js"></script> 

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
  <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>
    
    
	
    <script>
     $(document).ready(function(){

          $('select').material_select();
         
            $('#tipoconta').on('change', function() {
               if(this.value=='2'){
                 $('#corFunc').css('display', 'block');
               }
                else{
                    $('#corFunc').css('display', 'none');
                }
                   
            });
         
         $('#user').on('change', function() {
             
            $.post('php/Users/VerSeExiste.php', $(this).serialize(), function(resp) {
                      if(resp==1){
                        $('#user').val(null);
                        Materialize.toast("Já existe um utilizador com esse username", 4000, 'rounded');
                      }
                });
             
         });
         
         $('#pass2').on('change', function() {
           
             if($('#pass').val() != $('#pass2').val()){
                  $('#pass2').val(null);
                 Materialize.toast("As passwords não correspondem", 2000, 'rounded');
             }
                 
         });
     
         $( "form" ).submit(function( event ) {
         
             if($("#tipoconta").val() == "1" || $("#tipoconta").val() == "3" ){
                  if ( $("#nome").val() != "" && $("#user").val() != "" && $("#pass").val() == $("#pass2").val() && $("#email").val() != "" ) {
                       
                        $.post('php/Users/AddUser.php', $(this).serialize(), function(resp) {
                            Materialize.toast(resp, 3000, 'rounded',function(){window.location.replace('principal.php')});
                        });

                        // Cancel the actual form post so the page doesn't refresh
                        event.preventDefault();
                        return false;
                  }
             }
             else if($("#tipoconta").val() == "2")
             {
                  if($("#nome").val() != "" && $("#user").val() != "" && $("#pass").val() == $("#pass2").val() && $("#email").val() != "" && $("#valorcor").text()!="FFFFFF")
                  {
                    $.post('php/Users/AddUser.php', $(this).serialize(), function(resp) {
                           Materialize.toast(resp, 3000, 'rounded',function(){window.location.replace('principal.php')});
                        });

                        // Cancel the actual form post so the page doesn't refresh
                        event.preventDefault();
                        return false;
                  }
             }
          Materialize.toast('Preencha todos os campos', 2000, 'rounded')
          event.preventDefault();
        });
     });
     
        
    </script>
    
    
    </body>
  
</html>