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
$descricao = $_POST['descricao'];
$pessoa_responsavel = $_POST['pessoa_responsavel'];
$contacto_responsavel = $_POST['contacto_responsavel'];
$local = $_POST['local'];
/*
$id_cliente = 2;
$descricao = 'descricao';
$pessoa_responsavel = 'pessoa_responsavel';
$contacto_responsavel = 144241;
$local = 'local';*/

//query insert tab projeto
$statement = $conn_meta->prepare("INSERT INTO projeto(descricao, responsavel, contacto_responsavel, local, is_active)"
    . " VALUES ('$descricao', '$pessoa_responsavel', $contacto_responsavel, '$local', 1)");

$state_proj = $statement->execute();
$id_lastProject = $conn_meta->lastInsertId();


//query insert tab projeto_cliente
$sql_proj_cliente = $conn_meta->prepare("INSERT INTO projeto_cliente(id_projeto, id_cliente)"
    . " VALUES ($id_lastProject, $id_cliente)");

$state_pro_cli = $sql_proj_cliente->execute();
$id_lastProj_cliente = $conn_meta->lastInsertId();


if ($state_proj == 1 && $state_pro_cli == 1){
    $array_state = array('success'=>$state_proj);
    $json = json_encode($array_state);
    echo $json;
}


?>