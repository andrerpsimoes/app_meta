<?php

include("../../restrito.php");
include '../../configs/config.php'; // MetaveiroAppTestes


$id_servico = $_POST['id_servico'];

//update tab servico, is_active=0 (deleted)
$sql_delete = $conn_meta->prepare("UPDATE servico SET is_active=0 WHERE id='" . $id_servico . "'");
$sql_delete->execute();



?>