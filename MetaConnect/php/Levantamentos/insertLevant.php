<?php
/*
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
     session_destroy();
     header("Refresh:0");
  }*/


include '../../configs/config.php'; // MetaveiroAppTestes


$id_cliente = $_POST['id_cliente'];
$pedido_por = $_POST['pedido_por'];
$prioridade = $_POST['prioridade'];;
$observacoes = $_POST['observacoes'];
$mobiliario = $_POST['mobiliario'];
$copia_imp = $_POST['copia_imp'];
$video_proj = $_POST['video_proj'];
$video_conf = $_POST['video_conf'];
$audio = $_POST['audio'];
$equipamento = $_POST['equipamento'];
$relogio_ponto = $_POST['relogio_ponto'];
$erp = $_POST['erp'];
$ups = $_POST['ups'];
$servidor = $_POST['servidor'];
$switch_r = $_POST['switch_r'];
$router = $_POST['router'];
$wifi = $_POST['wifi'];
$radio_comun = $_POST['radio_comun'];
$central_tel = $_POST['central_tel'];
$coaxial = $_POST['coaxial'];
$cobre = $_POST['cobre'];
$fibra_otica = $_POST['fibra_otica'];
$bastidores = $_POST['bastidores'];
$medidas_auto = $_POST['medidas_auto'];
$portas_cf = $_POST['portas_cf'];
$compartimentacao = $_POST['compartimentacao'];
$desenfumagem = $_POST['desenfumagem'];
$extincao_agua = $_POST['extincao_agua'];
$extincao_auto = $_POST['extincao_auto'];
$sinalizacao_seg = $_POST['sinalizacao_seg'];
$extintores = $_POST['extintores'];
$sadg = $_POST['sadg'];
$sadir = $_POST['sadir'];
$sadi = $_POST['sadi'];
$cctv = $_POST['cctv'];
$controlo_acesso = $_POST['controlo_acesso'];


$array_areas = array($mobiliario,$copia_imp,$video_proj,$video_conf,$audio,$equipamento,$relogio_ponto,$erp,$ups,$servidor,$switch_r,$router,$wifi,$radio_comun,$central_tel,$coaxial,$cobre,$fibra_otica,$bastidores,$medidas_auto,$portas_cf,$compartimentacao,$desenfumagem,$extincao_agua,$extincao_auto,$sinalizacao_seg,$extintores,$sadg,$sadir,$sadi,$cctv,$controlo_acesso);
$areas_filtradas = array_filter($array_areas);
$timestamp = date('Y-m-d H:i:s');
//echo $timestamp;

//print_r($array_areas);
    
$statement = $conn_meta->prepare("INSERT INTO servico(id_cliente, recebido_por, pedido_por, data_hora, observacoes, prioridade, tipo_servico, id_proj_cliente, estado, is_active)"
    . " VALUES ($id_cliente, 'teste','$pedido_por', '$timestamp', '$observacoes', $prioridade, 1, null, 1, 1)");

$statement->execute();

$id_lastLevantamento = $conn_meta->lastInsertId();
//echo $id_lastLevantamento;

$var = array('id_cliente'=>$id_cliente, 'id_levantamento'=>$id_lastLevantamento);
$json = json_encode($var);
echo $json;


foreach ($areas_filtradas as $areas){
$query_ser_area = $conn_meta->prepare("INSERT INTO servico_area(id_area, id_servico, is_active)"
        . " VALUES ($id_lastLevantamento,$areas, 1)");

$query_ser_area->execute();
}

?>