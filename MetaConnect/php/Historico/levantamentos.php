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

$assistencias_cliente = '
                            <table class="striped centered" id="assistencias_cliente">
                                <thead>
                                    <tr>
                                        <th data-field="name"><a class="" style="color: black;">Nº</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Pedido por</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Observações</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Recebido por</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Prioridade</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Data</a></th>
                                    </tr>
                                </thead>

                                <tbody>';


$statement = $conn_meta->prepare("select id, id_cliente, pedido_por, counter, observacoes, recebido_por, prioridade, data_hora, estado from servico where id_cliente='" . $id_cliente . "' and tipo_servico=1 and is_active=1");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
    $assistencias_cliente .= '<tr id="' . $result["id"] . '">
                    <td class="counter" name="counter" id="counter" style="cursor:pointer;">' . $result["counter"] . '</td>
                    <td>'. $result["pedido_por"].'</td>';

    $textobs = $result["observacoes"];
    $tamanhoObs = strlen($textobs);
    if ($tamanhoObs >= 50) {

        $assistencias_cliente .= '<td width="300px;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="' . $result["observacoes"] . '">';
        $assistencias_cliente .= substr($textobs, 0, 50) . '...';
//$assistencias_cliente .= $tamanhoObs >= 50 ? substr($textobs, 0, 50) . '...' : $textobs;
        $assistencias_cliente .= '</td>';
    } else {
        $assistencias_cliente .= '<td width="300px;">';
        $assistencias_cliente .= $textobs;
        $assistencias_cliente .= '</td>';
    }

    $assistencias_cliente .= '<td>' . $result["recebido_por"] . '</td>
                     <td>';
    if ($result['prioridade'] == 1) {
        $assistencias_cliente .= 'Baixa';
    } elseif ($result['prioridade'] == 2) {
        $assistencias_cliente .= 'Média';
    } elseif ($result['prioridade'] == 3) {
        $assistencias_cliente .= 'Alta';
    }
    $assistencias_cliente .= '</td>
                    <td>';
    $datetimeFromSql = $result["data_hora"];
    $time = strtotime($datetimeFromSql);
    $myFormatForView = date("d/m/Y H:i:s", $time);
    $assistencias_cliente .= $myFormatForView;
    $assistencias_cliente .= '</td>
                     <td><a class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="Informação" name="BtnInfoLev" id="BtnInfoLev" style="cursor:pointer;"><img src="images/info.png" alt="" width="24" height="24" border="0"></a></td>
                     <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ver PDF" target="_blank" href="php/Levantamentos/pdfLevantamento.php?a=' . $result['id'] . '" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                     </tr>';
}

$assistencias_cliente .= ' </tbody>
                </table>';

$assistencias_cliente .= '<script> $(document).ready(function () {
$(".tooltipped").tooltip({delay: 50});
});
</script>';


echo $assistencias_cliente;
?>