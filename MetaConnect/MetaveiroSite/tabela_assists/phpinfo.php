
<?php
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"Emp_001", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$dataatual = date("Y-m-d");
$final=$dataatual;
$final=date('Y-m-d', strtotime("-2 month"));


if( $conn ) {
   
    $sql = "select intNumero, strCVDNome, strCVDLocalidade, CA_Zona , CA_Morada, dtmData ,strCVDMorada, strCVDCodPostal, strCVDTelefone, dtmDataAlteracao, CA_qPediu , CA_qRecebeuPedido, CA_nAvaria , CA_Modelo ,CA_Marca , CA_Escolha , CA_Observacoes  from Mov_Venda_Cab where strAbrevTpDoc= 'ASIST' and dtmData BETWEEN '".$final."' AND '".$dataatual."' order by dtmDataAlteracao desc ";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
 
  echo "<tr><td>"; 
  echo utf8_encode($row['intNumero']);
  echo "</td><td>";   
  echo utf8_encode($row['strCVDNome']);
  echo "</td><td>";   
  echo utf8_encode($row['strCVDLocalidade']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Zona']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Morada']);
  echo "</td><td>";   
  echo date_format($row['dtmData'],'Y-m-d');
  echo "</td><td>";   
  echo utf8_encode($row['strCVDMorada']);
  echo "</td><td>";   
  echo utf8_encode($row['strCVDCodPostal']);
  echo "</td><td>";   
  echo date_format($row['dtmDataAlteracao'],'Y-m-d');
  echo "</td><td>";   
  echo utf8_encode($row['CA_qPediu']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_qRecebeuPedido']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Modelo']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Marca']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Escolha']);
  echo "</td><td>";   
  echo utf8_encode($row['CA_Observacoes']);
  echo "</td></tr>"; 
}
sqlsrv_free_stmt( $stmt);


    
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>



