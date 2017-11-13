<?php
  if(isset($_POST['btnCriar']))
  {
    include('send_mail.php');
    echo "<h5 style='color:green;''>Email Enviado com Sucesso!.</h5>";
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Email</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--login modal-->

      
     
          <h1 class="text-center">Send email</h1>
          <br>
           
          <form class="form col-md-12 center-block" method="POST" action="register.php">
             
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" type="submit" value="criar" name="btnCriar">Criar</button>
           
            </div>


          </form>

   
	<!-- script references -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>