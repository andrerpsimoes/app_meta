<?php
include("../../restrito.php");
include '../../configs/config.php'; // MetaveiroAppTestes

$id_servico = $_POST['id_servico'];
$prioridade = $_POST['prioridade'];
$observacoes = $_POST['observacoes'];

//update tab servico, campos => prioridade, areas, observacoes
$sql_edit = $conn_meta->prepare("UPDATE servico SET prioridade = '" . $prioridade . "', observacoes = '" . $observacoes . "' WHERE id='" . $id_servico . "'");
$sql_edit->execute();


?>
