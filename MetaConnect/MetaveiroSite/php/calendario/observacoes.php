<?php

  $obs = $_POST['observacoes'];
$nmr = $_POST['nmrObs'];

try{ 

   $serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=Emp_001", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
    
    
    $query=$conn->prepare("UPDATE Mov_Venda_Cab
SET CA_Observacoes='".$obs."'
WHERE strAbrevTpDoc= 'ASIST' 
and intnumero= ".$nmr);
    
    
    $query->execute();
    
}catch(PDOException  $e ){
echo "Error: ".$e;
}
     header('Location: '.$_SERVER['HTTP_REFERER']);
?>