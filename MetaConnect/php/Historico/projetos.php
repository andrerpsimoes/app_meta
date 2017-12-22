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

$id_cliente = $_POST['id_cliente'];

$projeto_cliente = '
                            <table class="striped centered" id="projetos_cliente">
                                <thead>
                                    <tr>
                                        <th data-field="name"><a class="" style="color: black;">Descrição</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Responsável</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Contacto Responsável</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Local</a></th>
                                    </tr>
                                </thead>

                                <tbody>';


$statement = $conn_meta->prepare("select id_projeto, p.descricao, p.contacto_responsavel, p.local, p.responsavel "
        . "from projeto_cliente as pc inner join projeto as p on p.id = pc.id_projeto where pc.id_cliente= '" . $id_cliente . "'");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {

   $projeto_cliente .= '<tr id="' . $result["id_projeto"] . '">
                        <td>' . $result["descricao"] . '</td>
                        <td>' . $result["responsavel"] . '</td>
                        <td>' . $result["contacto_responsavel"] . '</td>
                        <td>' . $result["local"] . '</td>
                        <td><a class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="Informação" name="BtnInfoProj" id="BtnInfoProj" style="cursor:pointer;"><img src="images/info.png" alt="" width="24" height="24" border="0"></a></td>
            </tr>';
}

$projeto_cliente .= ' </tbody>
                </table>';



echo $projeto_cliente;
?>