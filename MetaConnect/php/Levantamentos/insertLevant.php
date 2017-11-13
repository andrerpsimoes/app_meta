<?php

include '../../configs/config.php'; // MetaveiroAppTestes


$id_cliente = $_POST['id_cliente'];
$pedido_por = $_POST['pedido_por'];
$prioridade = $_POST['prioridade'];
$zona = $_POST['zona'];
$local = $_POST['local'];
$contacto_responsavel = $_POST['contacto_responsavel'];
$observacoes = $_POST['observacoes'];
$mobiliario = $_POST['mobiliario'];
$copia_imp = $_POST['copia_imp'];

$array_areas = array($mobiliario,$copia_imp);
$areas_filtradas = array_filter($array_areas);
$timestamp = date('Y-m-d G:i:s');
//echo $timestamp;

print_r($array_areas);
    
$statement = $conn->prepare("INSERT INTO levantamento(id_cliente, pessoa_responsavel, local, data_hora, estado, is_active, prioridade, recebido_pessoa, zona, contato_responsavel, observacoes)"
    . " VALUES ($id_cliente, '$pedido_por', '$local', '$timestamp', 1, 1, $prioridade, 'teste', $zona, $contacto_responsavel, '$observacoes')");

$statement->execute();

$id_lastLevantamento = $conn->lastInsertId();
//echo $id;

foreach ($areas_filtradas as $areas){
$query_lev_area = $conn->prepare("INSERT INTO levantamento_area(id_levantamento, id_area, is_active)"
        . " VALUES ($id_lastLevantamento,$areas, 1)");

$query_lev_area->execute();
}

?>