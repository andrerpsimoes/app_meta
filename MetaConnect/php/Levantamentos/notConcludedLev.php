<?php

include("../../restrito.php");
include '../../configs/config.php'; // MetaveiroAppTestes

$id_servico = $_POST['id_servico'];

//update tab servico, estado=1
$sql_delete = $conn_meta->prepare("UPDATE servico SET estado=0 WHERE id='" . $id_servico . "'");
$sql_delete->execute();

?>