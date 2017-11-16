<?php
     $id_cliente = $_POST['id_cliente'];
     
     include '../configs/config2.php';
     
     $statement = $conn_etica->prepare("select strMorada_lin1, strLocalidade, strPostal, strNumContrib, strTelefone from Tbl_Clientes where intCodigo = $id_cliente");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    echo $json;
?>