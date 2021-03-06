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



$tableOrder = '
                            <table class="striped centered" id="tableOrder">
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

if (isset($_POST['subareas'])) {

    $subareas = $_POST['subareas'];
    $select_servArea = "select sa.id_area, s.id, s.counter, s.id_cliente, s.observacoes, s.recebido_por, s.prioridade, s.data_hora, s.estado, cab.CA_Assistencia "
            . "from servico_area sa "
            . "inner join servico as s on s.id = sa.id_servico "
            . "left join Emp_999.dbo.Mov_Venda_Cab cab on s.counter=cab.CA_Assistencia "
            . "where  s.tipo_servico = 2 and s.is_active=1 and";

    $i = 0;
    $len = count($subareas);
    foreach ($subareas as $key => $value) {
        if ($i == $len - 1) {
            $select_servArea .= "(sa.id_area = '$value')";
        } else {
            $select_servArea .= "(sa.id_area = '$value') or";
        }
        $i++;
    }
    $select_servArea .= " order by s.counter desc";
    //echo $select_servArea;

    $query_servOrder = $conn_meta->prepare($select_servArea);
    $query_servOrder->execute();
    $results = $query_servOrder->fetchAll(PDO::FETCH_ASSOC);


    foreach ($results as $result) {

        $cor = 'background-color:';
        if ($result['estado'] == '1' && $result['CA_Assistencia'] == $result['counter'])
            $cor .= 'green;';
        else if ($result['estado'] == '0' && $result['CA_Assistencia'] == $result['counter'])
            $cor .= 'orange;';
        else if ($result['estado'] == '1')
            $cor .= 'yellow;';
        else
            $cor .= '';


        $tableOrder .= '<tr id="' . $result["id"] . '">
                    <td class="counter" name="counter" id="counter" style="cursor:pointer;'. $cor.'">' . $result["counter"] . '</td>
                    <td width="300px;">';
        $result["id_cliente"];
        $sql_cliente = $conn_etica->prepare("select intCodigo, strNome from Tbl_Clientes where intCodigo ='" . $result['id_cliente'] . "'");
        $sql_cliente->execute();
        $cliente = $sql_cliente->fetch();
        $tableOrder .= $cliente['strNome'];
        $tableOrder .= '</td>';

        $textobs = $result["observacoes"];
        $tamanhoObs = strlen($textobs);
        if ($tamanhoObs >= 50) {

            $tableOrder .= '<td width="300px;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="' . $result["observacoes"] . '">';
            $tableOrder .= substr($textobs, 0, 50) . '...';
//$tableOrder .= $tamanhoObs >= 50 ? substr($textobs, 0, 50) . '...' : $textobs;
            $tableOrder .= '</td>';
        } else {
            $tableOrder .= '<td width="300px;">';
            $tableOrder .= $textobs;
            $tableOrder .= '</td>';
        }

        $tableOrder .= '<td>' . $result["recebido_por"] . '</td>
                     <td>';
        if ($result['prioridade'] == 1) {
            $tableOrder .= 'Baixa';
        } elseif ($result['prioridade'] == 2) {
            $tableOrder .= 'Média';
        } elseif ($result['prioridade'] == 3) {
            $tableOrder .= 'Alta';
        }
        $tableOrder .= '</td>
                    <td>';
        $datetimeFromSql = $result["data_hora"];
        $time = strtotime($datetimeFromSql);
        $myFormatForView = date("d/m/Y H:i:s", $time);
        $tableOrder .= $myFormatForView;
        $tableOrder .= '</td>
                     <td><a class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="Informação" name="BtnInfo" id="BtnInfo" style="cursor:pointer;"><img src="images/info.png" alt="" width="24" height="24" border="0"></a></td>
                     <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ver PDF" target="_blank" href="php/assistencias/pdfAssistencia.php?a=' . $result['id'] . '" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                     <td><a class="btn-floating waves-effect waves-light yellow darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" name="BtnEdit" id="BtnEdit" value=""><i class="material-icons">mode_edit</i></a></td>
                     <td><a class="btn-floating waves-effect waves-light deep-orange accent-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" name="BtnDelete" id="BtnDelete" value=""><i class="material-icons">delete_forever
                     </i></a></td>
                     </tr>';
    }

    $tableOrder .= ' </tbody>
                </table>';

    $tableOrder .= '<script> $(document).ready(function () {
$(".tooltipped").tooltip({delay: 50});
});
</script>';
    echo $tableOrder;
} else {
    echo '<div class="row center">
    <h5 style="color: red;">Selecione uma subárea ou limpe a pesquisa!</h5>
</div>';
}
?>

