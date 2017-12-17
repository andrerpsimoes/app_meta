<?php
/*
  include("restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } */

include '../../configs/config.php'; // MetaveiroAppTestes
include '../../configs/config2.php'; // eticadata DB


$id_servico = $_POST['id_servico'];
$id_tecnicos = $_POST['tecnicos_selecionados'];

if (isset($id_tecnicos)) {


    $insert_servicoTecnico = "INSERT INTO tecnico_servico(id_tecnico, id_servico) VALUES";
    $i = 0;
    $len = count($id_tecnicos);
    foreach ($id_tecnicos as $tecnicos) {
        if ($i == $len - 1) {
            $insert_servicoTecnico .= "($tecnicos,$id_servico)";
        } else {
            $insert_servicoTecnico .= "($tecnicos,$id_servico),";
        }
        $i++;
    }

    $query_serv_tec = $conn_meta->prepare($insert_servicoTecnico);
    $query_serv_tec->execute();
}


?>