<?php
include("restrito.php");
 $q=$_POST['tag'];

//global
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)

//metaveiro
$connectMETA = array( "Database"=>"MetaveiroApp", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectMETA);

echo $q;
echo $q;
echo $q;


if( $conn ) {
   
    $sql = "select nome from login where username like '%$q%'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $data[] = array(
		'value' => $row['nome'],
	);	

}
    echo json_encode($data);
flush();
sqlsrv_free_stmt( $stmt);
    
}else{
    echo "Não foi possivel estabelecer ligação com o servidor.<br />";
     die( print_r( sqlsrv_errors(), true));
}


?>




