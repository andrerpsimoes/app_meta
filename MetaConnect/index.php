<?php
   include("configs/config.php");
   session_start();
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 

      //md5 conversion
      $mypassword = md5($mypassword);

      // database query

      $query=$conn_meta->prepare("select id, nome , tipoconta, mail from login where username='".$myusername."' and pass='".$mypassword."'");
   
      $query->execute();
      $result = $query;
     $num_rows = $query->rowCount();
          
      if($num_rows == -1) {    
        foreach($result as $row)
         {
          $_SESSION["id"]= $row["id"];
          $_SESSION["nome"]= $row["nome"];
          $_SESSION["tipoconta"]= $row["tipoconta"];
          $_SESSION["mail"]= $row["mail"];
          $SESSION['CREATED'] = time();
          header("Location: page-principal.php");
         }
      }else {
       $error = "Nome ou Palavra-Passe incorreta!";
      }


    
   }
?>
<html>
   
   <head>
      <title>Metaveiro</title>

      <!-- materialize -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- custom css -->
      <link rel="stylesheet" type="text/css" href="css/login.css">

       <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
   
   <body>
      <div class="section"></div>

      <center>
         <div  class="container z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" id="main-wraper">
            
            <h4>MetaConnect</h4>
            <div class="section"></div>

            <form action = "" method = "post">
               <div class='row '>
                  <div class='input-field col s12'>
                     <input class='validate' type="text" name='username' id='email' required />
                     <label for='email'>Nome de utilizador</label>
                  </div>
               </div>
               <div class='row'>
                  <div class='input-field col m12'>
                     <input class='validate' type='password' name='password' id='password' required />
                     <label for='password'>Palavra-Passe</label>
                  </div>
                  <label style='float: right;'>
                     <b style="color: #cc0000;"><?php echo $error; ?></b>
                  </label>
               </div>
               <div class='row'>
                     <button type='submit' name='btn_login' class='col m12 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button>
               </div>
            </form>

         </div>
      </center>

   <!-- Scripting incorporation -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

   </body>
</html>