
<?php
$serverName = "metasede1.dyndns.org"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"Emp_001", "UID"=>"sa", "PWD"=>"Platinum01");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

 $nmr = htmlentities($_GET['nmr']);


if( $conn ) {
   
    
    
    $sql =  "select strCVDNome , strCVDMorada, strCVDCodPostal, CA_qPediu, strLogin,  CA_nAvaria, CA_Observacoes, CA_Concluido from Mov_Venda_Cab where strAbrevTpDoc= 'ASIST' and intNumero = '".$nmr."'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
    
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    echo "<hr>";
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Nome</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".utf8_encode($row['strCVDNome'])."\" readonly>";
  echo "</div>";
 echo "</div>";
 
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Morada</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".utf8_encode($row['strCVDMorada'])."\" readonly>";
  echo "</div>";
 echo "</div>";
    
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Cod-postal</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".utf8_encode($row['strCVDCodPostal'])."\" readonly>";
  echo "</div>";
 echo "</div>";
    
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Quem pediu</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".utf8_encode($row['CA_qPediu'])."\" readonly>";
  echo "</div>";
 echo "</div>";
    
    
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Quem recebeu</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<input type=\"text\" name=\"end\" class=\"form-control\" placeholder=\"".utf8_encode($row['strLogin'])."\" readonly>";
  echo "</div>";
 echo "</div>";
  

 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Avaria</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<div  name=\"avaria\" id=\"avaria\" disabled> ".utf8_encode($row['CA_nAvaria'])."</div>";
  echo "</div>";
 echo "</div>";   
    
 echo "<div class=\"form-group\">";
  echo "<label for=\"end\" class=\"col-sm-2 control-label\">Obs:</label>";
    echo "<div class=\"col-sm-10\">";
    echo "<textarea name=\"observacoes\" id=\"observacoes\" class=\"materialize-textarea\" disabled>".utf8_encode($row['CA_Observacoes'])."</textarea>";
     
  echo "</div>";
 echo "</div>";
   
      
    if($row['CA_Concluido']=="0"){
        echo "<input type=\"text\"  name=\"concl\" id=\"concl\" value=\"0\" class=\"hide\">";
        }
    else{
   
        echo "<input type=\"text\"  name=\"concl\" id=\"concl\" value=\"1\" class=\"hide\">";
    }
}
sqlsrv_free_stmt( $stmt); 
    
    
}else{
    echo "Não foi possivel estabelecer ligação com o servidor.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
