<?php
//global
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)
$dataatual = date("Y-m-d");
$final=$dataatual;
$final=date('Y-m-d', strtotime("-2 month"));

//metaveiro
$connectMETA = array( "Database"=>"Emp_001", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectMETA);


if( $conn ) {
   
    $sql = "select intNumero, strCVDNome,  dtmData from Mov_Venda_Cab where strAbrevTpDoc= 'ASIST' and dtmData BETWEEN '".$final."' AND '".$dataatual."' order by dtmDataAlteracao desc ";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
    $ultimo="";
    $cont=0;
        
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
 
    $date = date_format($row['dtmData'], 'Y-m-d');
    
  
    if($cont==0){
        echo "<optgroup label=\"".$date."\">";
        $ultimo=$date;
    }
    if($ultimo!=$date){
        echo "</optgroup>";
        echo "<optgroup label=\"".$date."\">";
        echo "<option  value=\"".$row['intNumero']."-".utf8_encode($row['strCVDNome'])."\">".$row['intNumero']." - ".utf8_encode($row['strCVDNome'])."</option>";
        $ultimo=$date;
    }else{
        echo "<option  value=\"".$row['intNumero']."-".utf8_encode($row['strCVDNome'])."\">".$row['intNumero']." - ".utf8_encode($row['strCVDNome'])."</option>";
    }
    
    $cont++;
}
sqlsrv_free_stmt( $stmt);


    
}else{
    echo "Não foi possivel estabelecer ligação com o servidor.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>



