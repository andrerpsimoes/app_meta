
<?php
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"MetaveiroApp", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

 $nmr = htmlentities($_GET['nmr']);


if( $conn ) {

   
    $sql =  " select a.title, e.nome 
from events a,login e 
where  a.title like '%".$nmr."%' 
and a.color= e.cor";
    
   
    
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
           echo " <div class=\"form-group\">
                    <label for=\"tecnAss\" class=\"col-sm-2 control-label\">Tecnicos na obra:</label>
                    <div class=\"col-sm-10\">
                    <textarea name=\"tecnAss\" id=\"tecnAss\" class=\"materialize-textarea\" disabled>";
        
        
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                echo utf8_encode($row['nome'])."&#13;&#10;";
         }
    
    
    echo "</textarea>
                </div>
          </div>";
sqlsrv_free_stmt( $stmt); 
   
  
}else{
    echo "Não foi possivel estabelecer ligação com o servidor.<br />";
     die( print_r( sqlsrv_errors(), true));
}


?>


