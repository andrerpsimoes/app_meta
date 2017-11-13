<?php
   include("snippets/config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      //md5 conversion
      $mypassword = md5($mypassword);

      // database query
      $sql = "SELECT id, permission FROM users WHERE name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $user_type = $row['permission'];
      $count = mysqli_num_rows($result);
      mysqli_close($db);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;          //guarda em sessao o username logado
         $_SESSION['login_user_type'] = $user_type;      //guarda as permissoes do user logado
         header("location: page-admin.php");
      }else {
         $error = "Nome ou Palavra-Passe incorreta!";
      }
   }
?>
<html>
   
   <head>
      <title>APPACDM Admin</title>

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
         <div  class="z-depth-3 y-depth-3 x-depth-3 grey lighten-4 row" id="main-wraper">
            
            <h4>APPACDM</h4>
            <div class="section"></div>

            <form action = "" method = "post">
               <div class='row'>
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