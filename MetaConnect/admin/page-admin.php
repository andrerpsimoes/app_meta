<?php
   include('snippets/session.php');
?>
<html">
   
   <head>
      <title>APPACDM Admin</title>

      <!-- materialize -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- custom css -->
      <link rel="stylesheet" type="text/css" href="css/admin.css">

       <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <meta charset="utf-8">
      <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

      <!-- Notifications on the browser -->
      <link href="css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />

      <!-- namespace init scripts -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
   	  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
      <script type="text/javascript" src="js/pnotify.custom.min.js"></script>

   </head>
   
   <body>
   		<div class="se-pre-con"></div>

		<!-- navbar -->
   		<nav class="brown lighten-4" role="navigation">
    		<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img src="../img/logonavbar.png" alt="Appacdm-Anadia Logo"></a>
      			<ul class="right hide-on-med-and-down">
      				<li><a class="brown-text text-darken-2" href="#">Gestão</a></li>
        			<li><a class="grey-text text-darken-4" target="_blanc" href="../">Visitar Página</a></li>
        			<li><a class="grey-text text-darken-4" href="snippets/logout.php">Terminar Sessão</a></li>
      			</ul>

      			<ul id="nav-mobile" class="side-nav">
      				<li><a class="brown-text text-darken-2" href="#">Gestão</a></li>
      				<li><a class="grey-text text-darken-4" target="_blanc" href="../">Visitar Página</a></li>
        			<li><a class="grey-text text-darken-4" href="snippets/logout.php">Terminar Sessão</a></li>
      			</ul>
      			
      			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    		</div>
  		</nav>
  		<!-- END navbar -->


    	<div class="section no-pad-bot">
    		<div class="container">
      			<br><br>
      			<h2 class=" center header brown-text">Página de Gestão</h2>
      			<br><br>
      			<?php
      				
      				//TEXTOS --------------------------------------------------------
					$sql = "SELECT DISTINCT locationText, idlocations FROM texts INNER JOIN locations WHERE location = idlocations;";
					$result = mysqli_query($db,$sql);
					while ($row = mysqli_fetch_assoc($result)) {

						echo '<br>';
						echo '<h5 class="grey-text center">'. $row['locationText'] .'</h5>';

						//CARD MODULE
						$lineCounter = 0;
	      				$sqlb = "SELECT text, title, photo, idtexts FROM texts WHERE location = " . $row['idlocations'];
	      				$resultb = mysqli_query($db,$sqlb);
	      				$count = mysqli_num_rows($resultb);
	      				while ($rowb = mysqli_fetch_assoc($resultb)) {
	      					if ($lineCounter%2 == 0) { echo '<div class="row">'; }
	      				?>
        						<div class="col m6">
          							<div class="card brown">
            							<div class="card-content white-text">
              								<span class="card-title"><?php echo $rowb['title']; ?></span>
              								<?php
                                if($rowb['photo'] != NULL){
                                  echo '<img id="photo-'.$rowb['idtexts'].'" class="thumbs" src="../'.$rowb['photo'].'">';
                              	}
                                echo '<textarea class="html-editor" id="editor-'.$rowb['idtexts'].'">'.$rowb['text'].'</textarea>';
                              ?>
            							</div>
            							<div class="card-action">
              								<a class="text-update" data-textid="<?php echo $rowb['idtexts'];?>">Atualizar texto</a>
              								<?php
              									if ($rowb['photo'] != NULL) {
              										echo '<label class="chPicLabel" for="input-'.$rowb['idtexts'].'"><a>Alterar Imagem</a></label>';
	        										echo '<input class="picinputs" style="display: none;" id="input-'.$rowb['idtexts'].'" data-textid="'.$rowb['idtexts'].'" data-originalpicpath="'.$rowb['photo'].'" type="file" accept=".jpeg">';
	        									}
              								?>
            							</div>
          							</div>
        						</div>
      						
      					<?php 
      						if ($lineCounter%2 != 0 or $lineCounter == $count-1) { echo '</div>'; }
      						$lineCounter++;
      					}
      					// END CARD MODULE
      				} 
      				//FIM TEXTOS -------------------------------------------------------
      			 mysqli_close($db); //close db connection
      			?>
      			<br><br>
    		</div>
  		</div>

      	<!-- Scripting incorporation -->
      	<script src="js/tinymce/tinymce.min.js"></script>
      	<script type="text/javascript" src="js/admin.js"></script>


   </body>
   
</html>



