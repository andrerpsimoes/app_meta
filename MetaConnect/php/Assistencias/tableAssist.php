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


$tableAssist = '

                            <h3 class="center" style="margin-bottom: 50px;">Gestão de Assistências</h3>

                            <table class="striped centered" id="tableAssist">
                                <thead>
                                    <tr>
                                        <th data-field="name"><a class="" style="color: black;">Nº</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Cliente</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Observações</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Recebido por</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Prioridade</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Data</a></th>
                                    </tr>
                                </thead>

                                <tbody>';


$statement = $conn_meta->prepare("select id, counter, id_cliente, observacoes, recebido_por, prioridade, data_hora, estado from servico where tipo_servico=2 and is_active=1");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
    $tableAssist .= '<tr id="' . $result["id"] . '">
                    <td class="counter" name="counter">' . $result["counter"] . '</td>
                    <td width="300px;">';
    $result["id_cliente"];
    $sql_cliente = $conn_etica->prepare("select intCodigo, strNome from Tbl_Clientes where intCodigo ='" . $result['id_cliente'] . "'");
    $sql_cliente->execute();
    $cliente = $sql_cliente->fetch();
    $tableAssist .= $cliente['strNome'];
    $tableAssist .= '</td>';

    $textobs = $result["observacoes"];
    $tamanhoObs = strlen($textobs);
    if ($tamanhoObs >= 50) {

        $tableAssist .= '<td width="300px;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="' . $result["observacoes"] . '">';
        $tableAssist .= substr($textobs, 0, 50) . '...';
//$tableAssist .= $tamanhoObs >= 50 ? substr($textobs, 0, 50) . '...' : $textobs;
        $tableAssist .= '</td>';
    } else {
        $tableAssist .= '<td width="300px;">';
        $tableAssist .= $textobs;
        $tableAssist .= '</td>';
    }

    $tableAssist .= '<td>' . $result["recebido_por"] . '</td>
                     <td>';
    if ($result['prioridade'] == 1) {
        $tableAssist .= 'Baixa';
    } elseif ($result['prioridade'] == 2) {
        $tableAssist .= 'Média';
    } elseif ($result['prioridade'] == 3) {
        $tableAssist .= 'Alta';
    }
    $tableAssist .= '</td>
                    <td>';
    $datetimeFromSql = $result["data_hora"];
    $time = strtotime($datetimeFromSql);
    $myFormatForView = date("d/m/Y H:i:s", $time);
    $tableAssist .= $myFormatForView;
    $tableAssist .= '</td>
                     <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ver PDF" target="_blank" href="php/assistencias/pdfAssistencia.php?a=' . $result['id'] . '" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                     <td><button class="btn-floating waves-effect waves-light yellow darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" name="BtnEdit" id="BtnEdit" value=""><i class="material-icons">mode_edit</i></button></td>
                     <td><a class="btn-floating waves-effect waves-light deep-orange accent-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" name="BtnDelete" id="BtnDelete" value=""><i class="material-icons">delete_forever
                     </i></a></td>
                     </tr>';
}

$tableAssist .= ' </tbody>
                </table>';

$tableAssist .= '<script> $(document).ready(function () {
$(".tooltipped").tooltip({delay: 50});
});
</script>';


echo $tableAssist;
?>