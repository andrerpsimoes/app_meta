<?php
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"Emp_001", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$dataatual = date("Y-m-d");
$final=$dataatual;
$final=date('Y-m-d', strtotime("-2 month"));


if( $conn ) {
   
    $sql = "select f.strNome from tbl_Funcionarios f, Tbl_Grh_Funcionarios fb where f.intCodigo=fb.intCodigo  and fb.bitInactivo= '0' and fb.strCodExercicio='EX 2016' and f.strCodDepartamento=2 group by f.strNome order by f.strNome desc";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
 
  echo "<option>".utf8_encode($row['strCVDNome'])."</option>";

}
sqlsrv_free_stmt( $stmt);


    
}else{
     echo "Não foi possivel estabelecer ligação com o servidor.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>



