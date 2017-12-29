<?php

include '../../configs/config.php'; // MetaveiroAppTestes

$sql_tec_assist = $conn_meta->prepare("select id_tecnico, data_inicio, data_fim from tecnico_servico where id_servico=122");
$sql_tec_assist->execute();
$tecnicos_assistencia = $sql_tec_assist->fetchAll();

foreach ($tecnicos_assistencia as $tecnicos_assist) {
    $tecnicos_assist['data_inicio'] . '<br>';
    $tecnicos_assist['data_fim'];
}

$datetimeFromSql_ini = $tecnicos_assist['data_inicio'];
$time_ini = strtotime($datetimeFromSql_ini);
$myFormatForView_ini = date("Y/m/d H:i", $time_ini);

$data_ini = explode(' ', $myFormatForView_ini);
$dia_ini = $data_ini[0];
$hora_ini = $data_ini[1];


echo "Dia inicial: " . $dia_ini;
echo "<br>Hora inicial: " . $hora_ini;


$datetimeFromSql_fin = $tecnicos_assist['data_fim'];
$time_fin = strtotime($datetimeFromSql_fin);
$myFormatForView_fin = date("Y/m/d H:i", $time_fin);

$data_fin = explode(' ', $myFormatForView_fin);
$dia_fin = $data_fin[0];
$hora_fin = $data_fin[1];

echo "<br>Dia final: " . $dia_fin;
echo "<br>Hora final: " . $hora_fin;

?>