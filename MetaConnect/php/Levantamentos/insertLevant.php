<?php

include("../../restrito.php");

include '../../configs/config.php'; // MetaveiroAppTestes

$id_cliente = $_POST['id_cliente'];
$pedido_por = $_POST['pedido_por'];
$prioridade = $_POST['prioridade'];
$observacoes = $_POST['observacoes'];
$cod_postal = $_POST['cod_postal'];
$morada = $_POST['morada'];
$localidade = $_POST['localidade'];


$timestamp = date('Y-m-d H:i:s');

//caso haja projeto
if (isset($_POST['id_projeto']) && $_POST['id_projeto'] != 0) {
    //saber qual o id da tabela projeto_cliente para inserir na tabela serviço
    $query_proj_cli = $conn_meta->prepare("SELECT pc.id, p.codigo_postal,p.morada,p.local FROM projeto_cliente pc, projeto p WHERE id_projeto=" . $_POST['id_projeto'] . "and id_cliente=$id_cliente");
    $query_proj_cli->execute();
    $result = $query_proj_cli->fetch(); //um unico resultado
    $id_proj_cli = $result[0];
    $cod_postal = $result[1];
    $morada = $result[2];
    $localidade = $result[3];

    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($cod_postal) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

    $res = file_get_contents($url);
    $json = json_decode($res);
    
if ($json->status != 'NOT_FOUND') {
        $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($cod_postal) . "&avoid=highways&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
        $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
        $json_Semautoestrada = json_decode($res_Semautoestrada);

        $distancia = $json->routes[0]->legs[0]->distance->text;
        $duracao = $json->routes[0]->legs[0]->duration->text;

        $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
        $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;

        $local_chegada = $cod_postal;
    } else {

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($morada) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

        $res2 = file_get_contents($url2);

        $json2 = json_decode($res2);

        if ($json->status != 'NOT_FOUND') {
            $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($morada) . "&avoid=tolls|highways|ferries&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
            $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
            $json_Semautoestrada = json_decode($res_Semautoestrada);

            $distancia = $json->routes[0]->legs[0]->distance->text;
            $duracao = $json->routes[0]->legs[0]->duration->text;

            $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
            $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;
            $local_chegada = $morada;
        } else {
            $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($localidade) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

            $res = file_get_contents($url);

            $json = json_decode($res);

            if ($json->status != 'NOT_FOUND') {
                $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($localidade) . "&avoid=tolls|highways|ferries&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
                $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
                $json_Semautoestrada = json_decode($res_Semautoestrada);

                $distancia = $json->routes[0]->legs[0]->distance->text;
                $duracao = $json->routes[0]->legs[0]->duration->text;

                $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
                $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;
                $local_chegada = $localidade;
            } else {
                $distancia = "INVÁLIDO";
                $duracao = "INVÁLIDO";
                $local_chegada = "INVÁLIDO";
                $distancia_semauto = "INVÁLIDO";
                $duracao_semauto = "INVÁLIDO";
            }
        }
    }

    //insert tab servico um levantamento
    $statement = $conn_meta->prepare("INSERT INTO servico(id_cliente, recebido_por, pedido_por, data_hora, observacoes, prioridade, tipo_servico, id_proj_cliente, estado, is_active,local_partida, local_chegada, distancia, duracao, distanciaAestrada, duracaoAestrada)"
            . " VALUES ($id_cliente, '" . $_SESSION['nome'] . "','$pedido_por', '$timestamp', '$observacoes', $prioridade, 1, $id_proj_cli, 0, 1, 'Metaveiro', '$local_chegada', '$distancia_semauto', '$duracao_semauto', '$distancia', '$duracao')");


    $statement->execute();

    $id_lastLevantamento = $conn_meta->lastInsertId();
} else {

    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($cod_postal) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

    $res = file_get_contents($url);

    $json = json_decode($res);
    if ($json->status != 'NOT_FOUND') {
        $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($cod_postal) . "&avoid=tolls|highways|ferries&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
        $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
        $json_Semautoestrada = json_decode($res_Semautoestrada);

        $distancia = $json->routes[0]->legs[0]->distance->text;
        $duracao = $json->routes[0]->legs[0]->duration->text;

        $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
        $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;
        $local_chegada = $cod_postal;
    } else {

        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($morada) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

        $res = file_get_contents($url);

        $json = json_decode($res);

        if ($json->status != 'NOT_FOUND') {
            $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($morada) . "&avoid=tolls|highways|ferries&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
            $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
            $json_Semautoestrada = json_decode($res_Semautoestrada);

            $distancia = $json->routes[0]->legs[0]->distance->text;
            $duracao = $json->routes[0]->legs[0]->duration->text;

            $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
            $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;
            $local_chegada = $morada;
        } else {
            $url = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($localidade) . "&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";

            $res = file_get_contents($url);

            $json = json_decode($res);

            if ($json->status != 'NOT_FOUND') {
                $Url_Semautoestrada = "https://maps.googleapis.com/maps/api/directions/json?origin=%27Arruamento%20D%20Lote%2036,%203854-909%20Albergaria-aVelha%27&destination=" . urlencode($localidade) . "&avoid=tolls|highways|ferries&mode=DRIVING&key=AIzaSyA5_PaBAk9nBXye99o6fAyJgb1BrQuegtg";
                $res_Semautoestrada = file_get_contents($Url_Semautoestrada);
                $json_Semautoestrada = json_decode($res_Semautoestrada);

                $distancia = $json->routes[0]->legs[0]->distance->text;
                $duracao = $json->routes[0]->legs[0]->duration->text;

                $distancia_semauto = $json_Semautoestrada->routes[0]->legs[0]->distance->text;
                $duracao_semauto = $json_Semautoestrada->routes[0]->legs[0]->duration->text;
                $local_chegada = $localidade;
            } else {
                $distancia = "INVÁLIDO";
                $duracao = "INVÁLIDO";
                $local_chegada = "INVÁLIDO";
            }
        }
    }

    //insert tab servico uma Assistencia
    $statement = $conn_meta->prepare("INSERT INTO servico(id_cliente, recebido_por, pedido_por, data_hora, observacoes, prioridade, tipo_servico, id_proj_cliente, estado, is_active, local_partida, local_chegada, distancia, duracao, distanciaAestrada, duracaoAestrada)"
            . " VALUES ($id_cliente, '" . $_SESSION['nome'] . "','$pedido_por', '$timestamp', '$observacoes', $prioridade, 1, NULL, 0, 1, 'Metaveiro', '$local_chegada', '$distancia_semauto', '$duracao_semauto', '$distancia', '$duracao')");

    $statement->execute();

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

$jsonfinal = json_encode(array('id_levantamento' => $id_lastLevantamento));
echo $jsonfinal;
?>