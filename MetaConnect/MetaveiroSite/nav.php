<?php

$conta=$_SESSION["tipoconta"];


if($conta=="1")
{
?>
   <nav class="gray"  role="navigation">
        <div class="nav-wrapper container">

            <ul id="assistdropdown" class="dropdown-content">
             <!-- <li><a href="Assistencias.php">Assistências</a></li>-->
              <li><a href="AssistenciasEticadata.php">Assistências Eticadata</a></li>
              <li class="divider"></li>
              <li><a href="NovaAssist.php">Nova Assistência</a></li>
            </ul>
            
            
          <ul class="left hide-on-med-and-down" >
              <li><a href="principal.php" style="color: white;">METAVEIRO</a></li>
              <li><a href="calendario.php">Calendario</a></li>
              <li><a href="NovoUser.php">Nova Conta</a></li> 
              <li><a class="dropdown-button" data-activates="assistdropdown">Assistências<i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
            <li> <a href="#contact"><?php echo $_SESSION["nome"]?></a></li>
            <li><a href="?logout=yes">Sair</a></li>
          </ul>

          <ul id="nav-mobile" class="side-nav">
              <li><a href="principal.php">METAVEIRO</a></li>
              <li><a href="calendario.php">Calendario</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
               <li><a href="NovoUser.php">Nova Conta</a></li>
              <!--  <li><a href="Assistencias.php">Assistências</a></li>-->
              <li><a href="AssistenciasEticadata.php">Assistências Eticadata</a></li>
              <br>
              <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
              <li><a href="?logout=yes">Sair</a></li>
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>
<?php
}else if($conta=="2"){
    
?>
     <nav class="gray"  role="navigation">
        <div class="nav-wrapper container">

          <ul class="left hide-on-med-and-down" >
              <li><a href="principal.php" style="color: white;">METAVEIRO</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
              <li><a href="calendariotecnico.php">Calendario</a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
            <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
            <li><a href="?logout=yes">Sair</a></li>
          </ul>

          <ul id="nav-mobile" class="side-nav">
              <li><a href="principal.php">METAVEIRO</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
                 <li><a href="calendariotecnico.php">Calendario</a></li>
              <br>
              <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
              <li><a href="?logout=yes">Sair</a></li>
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>
<?php
}else if($conta=="3"){
    
?>
      <nav class="gray"  role="navigation">
        <div class="nav-wrapper container">

          
            <ul id="testes" class="dropdown-content">
              <li><a href="pendentes.php">Pendentes</a></li>
              <li><a href="AddExtintores.php">Extintores</a></li>
              
            </ul>
            <ul id="assistdropdown" class="dropdown-content">
              <li><a href="Assistencias.php">Assistências</a></li>
              <li><a href="AssistenciasEticadata.php">Assistências Eticadata</a></li>
              <li class="divider"></li>
              <li><a href="NovaAssist.php">Nova Assistência</a></li>
            </ul>
            
            
          <ul class="left hide-on-med-and-down" >
              <li><a href="principal.php" style="color: white;">METAVEIRO</a></li>
              <li><a href="calendario.php">Calendario</a></li> 
                <li><a href="NovoUser.php">Nova Conta</a></li> 
              <li><a class="dropdown-button" data-activates="testes">Para testes<i class="material-icons right">arrow_drop_down</i></a></li>
              <li><a class="dropdown-button" data-activates="assistdropdown">Assistências<i class="material-icons right">arrow_drop_down</i></a></li>

          </ul>
          <ul class="right hide-on-med-and-down">
            <li> <a href="#contact"><?php echo $_SESSION["nome"]?></a></li>
            <li><a href="?logout=yes">Sair</a></li>
          </ul>

          <ul id="nav-mobile" class="side-nav">
              <li><a href="principal.php">METAVEIRO</a></li>
              <li><a href="calendario.php">Calendario</a></li>
              <li><a href="pendentes.php">Pendentes</a></li>
              <li><a href="AddExtintores.php">Extintores</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
              <li><a href="NovoUser.php">Nova Conta</a></li>
              <li><a href="Assistencias.php">Assistências</a></li>
              <li><a href="AssistenciasEticadata.php">Assistências Eticadata</a></li>
              <br>
              <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
              <li><a href="?logout=yes">Sair</a></li>
          </ul>
            
            
            
            
            
            
            
            
   
          <ul id="nav-mobile" class="side-nav">
              <li><a href="principal.php">METAVEIRO</a></li>
              <li><a href="calendario.php">Calendario</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
               <li><a href="NovoUser.php">Nova Conta</a></li>
              <!--  <li><a href="Assistencias.php">Assistências</a></li>-->
              <li><a href="AssistenciasEticadata.php">Assistências Eticadata</a></li>
              <br>
              <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
              <li><a href="?logout=yes">Sair</a></li>
          </ul>
            
            
            
            
            
            
            
            
            
            
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>
<?php
}
    else{
        
?>
   <nav class="gray"  role="navigation">
        <div class="nav-wrapper container">

          <ul class="left hide-on-med-and-down" >
              <li><a href="principal.php" style="color: white;">METAVEIRO</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
            <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
            <li><a href="?logout=yes">Sair</a></li>
          </ul>

          <ul id="nav-mobile" class="side-nav">
              <li><a href="principal.php">METAVEIRO</a></li>
              <li><a href="NovaAssist.php">Abrir Assistência</a></li>
              <br>
              <li> <a href="#contact"><?php echo $_SESSION["nome"] ?></a></li>
              <li><a href="?logout=yes">Sair</a></li>
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
      </nav>
<?php
 }
 
?>

<!DOCTYPE html>
<html lang="en">

<body>
    
</body>

</html>
