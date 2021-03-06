<?php


include("../../restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  }

include '../../configs/config.php'; // MetaveiroAppTestes
include '../../configs/config2.php'; // eticadata DB

$id_servico = $_POST['id_servico'];
$hora_ini = $_POST['hora_ini'];
$dia_ini = $_POST['dia_ini'];
$hora_fin = $_POST['hora_fin'];
$dia_fin = $_POST['dia_fin'];

$datetime_ini = $dia_ini . ' ' . $hora_ini;
$datetime_fin = $dia_fin . ' ' . $hora_fin;

//echo $datetime;
if (isset($_POST['tecnicos_selecionados']) == null) {
    $sql_eliminaTudo = "delete FROM tecnico_servico where id_servico=" . $id_servico;
    
     $query_delete = $conn_meta->prepare($sql_eliminaTudo);
        $query_delete->execute();
        
   
    return 0;
}
$id_tecnicos_novos=$_POST['tecnicos_selecionados'];

$sql_select_tecnico_servico = $conn_meta->prepare("SELECT id_tecnico FROM tecnico_servico where id_servico='" . $id_servico . "'");
$sql_select_tecnico_servico->execute();
$select_existentes = $sql_select_tecnico_servico->fetchAll();


$existentes = array();
$novos = array();

foreach ($id_tecnicos_novos as $key => $value) {
    $novos[] = $value;
}

foreach ($select_existentes as $tec_selec) {
    $existentes[] = $tec_selec['id_tecnico'];
}

$ids_to_remove = array_diff($existentes, $novos);
/* echo "Remover" . "<pre>";
  print_r($ids_to_remove);
  echo "</pre>";
  echo "Inserir" . "<pre>"; */
$ids_to_insert = array_diff($novos, $existentes);
/* print_r($ids_to_insert);
  echo "</pre>";
 */


if (isset($id_tecnicos_novos) && empty($select_existentes)) {


    $insert_servicoTecnico = "INSERT INTO tecnico_servico(id_tecnico, id_servico, data_inicio, data_fim) VALUES";
    $i = 0;
    $len = count($id_tecnicos_novos);
    foreach ($id_tecnicos_novos as $tecnicos) {
        if ($i == $len - 1) {
            $insert_servicoTecnico .= "($tecnicos,$id_servico, '$datetime_ini', '$datetime_fin')";
        } else {
            $insert_servicoTecnico .= "($tecnicos,$id_servico, '$datetime_ini', '$datetime_fin'),";
        }
        $i++;
    }
    //echo $insert_servicoTecnico;

    $query_serv_tec = $conn_meta->prepare($insert_servicoTecnico);
    $query_serv_tec->execute();
} elseif (isset($id_tecnicos_novos)) {

    $len = count($ids_to_remove);
    if ($len >= 1) {
        $delete_ids = "DELETE FROM tecnico_servico WHERE id_servico='" . $id_servico . "' and (";
        $i = 0;

        foreach ($ids_to_remove as $key => $value) {
            if ($i == $len - 1) {
                $delete_ids .= "id_tecnico = '" . $value . "'";
            } else {
                $delete_ids .= "id_tecnico = '" . $value . "' or ";
            }

            $i++;
        }
        $delete_ids .= ")";
        //echo $delete_ids; //query to delete ids tecnicos 'desatribuidos'
        //echo "<br>";
        $query_delete = $conn_meta->prepare($delete_ids);
        $query_delete->execute();
    }

    $len = count($ids_to_insert);
    if ($len >= 1) {
        $insert_servicoTecnico = "INSERT INTO tecnico_servico(id_tecnico, id_servico, data_inicio, data_fim) VALUES";
        $i = 0;

        foreach ($ids_to_insert as $insert) {
            if ($i == $len - 1) {
                $insert_servicoTecnico .= "($insert,$id_servico, '$datetime_ini', '$datetime_fin')";
            } else {
                $insert_servicoTecnico .= "($insert,$id_servico, '$datetime_ini', '$datetime_fin'),";
            }
            $i++;
        }
        //echo $insert_servicoTecnico;

        $query_insert = $conn_meta->prepare($insert_servicoTecnico);
        $query_insert->execute();
    }
}
?>