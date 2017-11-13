


<?php
header('Content-type: text/plain; charset=utf-8');
 $nome = $_GET['nome'];

try{ 

   $serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=Emp_001", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
    
   
    $query=$conn->prepare("select intNumero, CA_qPediu,strLogin,  CA_nAvaria, CA_Observacoes 
from Mov_Venda_Cab 
where strAbrevTpDoc='ASIST' 
and strCVDNome='".$nome."' 
order by dtmDataAlteracao desc");

    
    $query->execute();
    $result = $query;
    
  echo " <table>";
  echo " <thead>";
    echo " <th  data-field=\"intNumero\" >Numero</th>
                              <th data-field=\"CA_qPediu\">Quem Pediu</th>
                              <th data-field=\"strLogin\">Quem recebeu</th>
                              <th data-field=\"CA_nAvaria\">Avaria</th>
                              <th  data-field=\"CA_Observacoes\">Obs</th>";
  echo " </thead>";
    
    
    
  foreach($result as $row)
     {
        echo "<tr> <td>"; 
      echo $row['intNumero'];
     echo "</td> <td>";   
      echo $row['CA_qPediu'];
     echo "</td> <td>"; 
    echo $row['strLogin'];
    echo "</td> <td>"; 
    echo $row['CA_nAvaria'];
    echo "</td> <td>"; 
    echo $row['CA_Observacoes'];
     echo "</td> </tr>"; 
     }
    
    
    echo  "</table>";
}catch(PDOException  $e ){
echo "Error: ".$e;
}

?>