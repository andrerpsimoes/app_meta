<?php

include("../../restrito.php");

include '../../configs/config.php'; // MetaveiroAppTestes

$id_cliente = $_POST['id_cliente'];
$pedido_por = $_POST['pedido_por'];
$prioridade = $_POST['prioridade'];
$observacoes = $_POST['observacoes'];



$timestamp = date('Y-m-d H:i:s');

//caso haja projeto
if (isset($_POST['id_projeto'])) {
    //saber qual o id da tabela projeto_cliente para inserir na tabela serviço
    $query_proj_cli = $conn_meta->prepare("SELECT id FROM projeto_cliente WHERE id_projeto=" . $_POST['id_projeto'] . "and id_cliente=$id_cliente");
    $query_proj_cli->execute();
    $result = $query_proj_cli->fetch(); //um unico resultado
    $id_proj_cli = $result[0];

    //insert tab servico um levantamento
    $statement = $conn_meta->prepare("INSERT INTO servico(id_cliente, recebido_por, pedido_por, data_hora, observacoes, prioridade, tipo_servico, id_proj_cliente, estado, is_active)"
            . " VALUES ($id_cliente, '".$_SESSION['nome']."','$pedido_por', '$timestamp', '$observacoes', $prioridade, 1, $id_proj_cli, 1, 1)");

    $statement->execute();

    $id_lastLevantamento = $conn_meta->lastInsertId();
} else {
    //insert tab servico um levantamento
    $statement = $conn_meta->prepare("INSERT INTO servico(id_cliente, recebido_por, pedido_por, data_hora, observacoes, prioridade, tipo_servico, id_proj_cliente, estado, is_active)"
            . " VALUES ($id_cliente, '".$_SESSION['nome']."','$pedido_por', '$timestamp', '$observacoes', $prioridade, 1, NULL, 1, 1)");

    $statement->execute();

    $sql_counter = $conn_meta->prepare("select top 1 counter from servico where tipo_servico=1 order by counter DESC");
    $sql_counter->execute();
    $counterResult = $sql_counter->fetch();
    $counter = $counterResult['counter'];
    

    $id_lastLevantamento = $conn_meta->lastInsertId();
}

if (isset($_POST['selecionados'])) {

    $areas_filtradas = array_filter($_POST['selecionados']);

    $insertAreas = "INSERT INTO servico_area(id_area, id_servico, is_active) VALUES";
    $i = 0;
    $len = count($areas_filtradas);
    foreach ($areas_filtradas as $areas) {
        if ($i == $len - 1) {
            $insertAreas .= "($areas,$id_lastLevantamento, 1)";
        } else {
            $insertAreas .= "($areas,$id_lastLevantamento, 1),";
        }
        $i++;
    }

    $query_ser_area = $conn_meta->prepare($insertAreas);
    $query_ser_area->execute();
}

$json = json_encode(array('id_levantamento' => $id_lastLevantamento));
echo $json;
?>