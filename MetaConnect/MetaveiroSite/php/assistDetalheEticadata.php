<?php

 $nmr = htmlentities($_GET['nmr']);

try{ 

    include('bdd.php');
    $query=$conn->prepare("select id,nomecliente,moradacliente,codPostalcliente,loccliente,contribcliente,qpediu,qrecebeu,zona,moradaobra,avaria,estado,importancia,contador,datacriada,cctv,sadi,ria,certificacoes,levantamentos,telecomunicacoes,msadi,mextintores,rponto,informatica,sadir,sadg,contador from assistencias where contador='".$nmr."'");

    $query->execute();
    $result = $query;

    $cont=0;
  
    foreach($result as $row)
     {
        if($cont==0)
        {
            echo "<h4 class=\"modal-title\" id=\"myModalLabel\">Informação Assistência (".$row['contador'].")</h4>";
                 echo "</div>";
			  echo "<div class=\"modal-body\">";
        }
        
     echo "<div class=\"form-group\">";
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Nome</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['nomecliente']."\" readonly>";
       echo "</div>";
        
        echo "<label for=\"end\" class=\"col-sm-2 control-label\">Morada</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['moradacliente']."\" readonly>";
       echo "</div>";
        
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Cod. Postal</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['codPostalcliente']."\" readonly>";
       echo "</div>";
        
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Localidade</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['loccliente']."\" readonly>";
       echo "</div>";
        
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Contribuinte</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['contribcliente']."\" readonly>";
       echo "</div>"; 
         
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Quem Pediu</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['qpediu']."\" readonly>";
       echo "</div>";
        
       echo "<label for=\"end\" class=\"col-sm-2 control-label\">Quem Recebeu</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['qrecebeu']."\" readonly>";
       echo "</div>";
        
         echo "<label for=\"end\" class=\"col-sm-2 control-label\">Zona</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['zona']."\" readonly>";
       echo "</div>";
        
         echo "<label for=\"end\" class=\"col-sm-2 control-label\">Morada Obra</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['moradaobra']."\" readonly>";
       echo "</div>";
        
         echo "<label for=\"end\" class=\"col-sm-2 control-label\">Avaria</label>";
        echo "<div class=\"col-sm-10\">";
        echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".$row['avaria']."\" readonly>";
       echo "</div>";
        
      echo "</div>";
        $cont++;
     }
   
}catch(PDOException  $e ){
//echo "Não foi possivel contactar o servidor.";
    echo "Error: ".$e;
}

?>