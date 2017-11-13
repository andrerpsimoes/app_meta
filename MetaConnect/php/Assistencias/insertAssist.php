<?php

include '../../configs/config.php'; // eticadata MetaveiroAppTestes


$id_cliente = $_POST['id_cliente'];
$pedido_por = $_POST['pedido_por'];
$prioridade = $_POST['prioridade'];
$zona = $_POST['zona'];
$local = $_POST['local'];
$contacto_responsavel = $_POST['contacto_levantamento'];
$observacoes = $_POST['observacoes'];


$timestamp = date('Y-m-d G:i:s');
//echo $timestamp;

    
$statement = $conn->prepare("INSERT INTO assistencia(id_cliente, pessoa_responsavel, local, data_hora, estado, is_active, prioridade, recebido_pessoa, zona, contacto_responsavel, observacoes)"
    . " VALUES ($id_cliente, '$pedido_por', '$local', '$timestamp', 1, 1, $prioridade, 'teste', $zona, $contacto_responsavel, '$observacoes')");

$statement->execute();
    
?>