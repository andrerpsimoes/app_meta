
<?php
/*metaveiro*/
$connectMETA = array( "Database"=>"Emp_001", "UID"=>"sa", "PWD"=>"Platinum01", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( "metasede1.dyndns.org", $connectMETA);

  $avaria = $_POST['textoAvaria'];
  $nmr = $_POST['nmr'];

    if( $conn ) {

        
        $sql = "update Mov_Venda_Cab
                set CA_nAvaria= '".$avaria."'
                 where intNumero=".$nmr."
                 and strAbrevTpDoc='ASIST'";

    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }


    sqlsrv_free_stmt( $stmt);

    }else{
        echo "Não foi possivel estabelecer ligação com o servidor.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
   header('Location: '.$_SERVER['HTTP_REFERER']);

?>








