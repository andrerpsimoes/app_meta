<?php

$dataatual = date("Y-m-d");
$final=$dataatual;
$final=date('Y-m-d', strtotime("-2 month"));



try{ 

   $serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=Emp_001", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
    
    
    $query=$conn->prepare("select intNumero,strCVDMorada,strCVDCodPostal, strCVDNome, CA_nAvaria, CA_Concluido from Mov_Venda_Cab where strAbrevTpDoc= 'ASIST' and dtmData BETWEEN '".$final."' AND '".$dataatual."' order by dtmDataAlteracao desc ");

    
    $query->execute();
    $result = $query;
    
    
    
    foreach($result as $row)
     {
      echo "<tr style=\"cursor: pointer;\"><td  data-toggle=\"modal\" data-target=\"#exampleModal\">"; 
      echo $row['intNumero'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['strCVDNome'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['strCVDMorada']."<br> Cod-postal:".$row['strCVDCodPostal'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['CA_nAvaria'];
      echo "</td><td>";
        if($row['CA_Concluido']==1){
              echo " <input type=\"checkbox\" id=\"".$row['intNumero']."\" checked />
                    <label for=\"".$row['intNumero']."\"></label>";
              echo "</td></tr>"; 
        }else{
             echo " <input type=\"checkbox\" id=\"".$row['intNumero']."\" />
                    <label for=\"".$row['intNumero']."\"></label>";
             echo "</td></tr>"; 
        }
     }

}catch(PDOException  $e ){
echo "Error: ".$e;
}
