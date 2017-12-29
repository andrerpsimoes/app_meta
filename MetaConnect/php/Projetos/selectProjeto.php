<?php


  include("../../restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } 

include '../../configs/config.php'; // MetaveiroAppTestes

$id_cliente = $_POST['id_cliente'];


if(!$id_cliente == NULL){
$select_proj = '
<select class="browser-default" id=select>
<option value = "" disabled selected>Escolha um projeto</option>';

 $query = $conn_meta->prepare("select id_projeto, id_cliente, (select descricao from projeto where projeto_cliente.id_projeto = projeto.id) as nome_projeto from projeto_cliente where id_cliente  = $id_cliente");
$query->execute();
$results_proj = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($results_proj as $projetos) {
    $select_proj.= "<option value='" . $projetos['id_projeto'] . "'>" . $projetos['nome_projeto'] . "</option>";
};

$select_proj.='</select>';

echo $select_proj;
}else{
    echo "Preencha o campo cliente!";
}



?>