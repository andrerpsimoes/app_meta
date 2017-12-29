<?php

include("../../restrito.php");

include '../configs/config2.php';

$statement = $conn_etica->prepare("select intCodigo, strNome from Tbl_Clientes");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo $json;
?>