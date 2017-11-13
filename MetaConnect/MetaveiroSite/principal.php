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
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meta.css"> 
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

    <!-- Optional theme -->
   <script src="js/jquery.js"></script>
    <script src="js/meta.js"></script> 
    <script  src="js/bootstrap.min.js"> </script>
    
    <!-- Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    </head>
<body>
    
    <?php
    include("nav.php");
?>  
    
    
    
<!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.custom.min.js"></script>
    <!-- Materialize -->
	  <script src="js/init.js"></script>
      <script src="js/materialize.js"></script>
	
    
    
    </body>
  
</html>