<?php

$nmr = $_POST['nmr2'];
$conc = 0;
if (isset($_POST['concluir'])) {
$conc = 1;
    
} else {

   $conc =0;
}

try{ 

   $serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=Emp_001", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
    
  
    $query=$conn->prepare("UPDATE Mov_Venda_Cab
SET CA_Concluido=".$conc."
WHERE strAbrevTpDoc= 'ASIST' 
and intnumero= ".$nmr);
    
    
    $query->execute();
 
   // echo $nmr ."<br>". $conc;
    
    
}catch(PDOException  $e ){
echo "Error: ".$e;
}
     header('Location: '.$_SERVER['HTTP_REFERER']);
?>