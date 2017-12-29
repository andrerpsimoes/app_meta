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


$tableLev = '
                            <table class="striped centered" id="tableLev">
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


$statement = $conn_meta->prepare("select s.id, s.counter, s.id_cliente, s.observacoes, s.recebido_por, s.prioridade, s.data_hora, s.estado, cab.CA_Levantamento

from servico s left join Emp_999.dbo.Mov_Venda_Cab cab on s.counter=cab.CA_Levantamento

where s.tipo_servico=1 and s.is_active=1
order by s.counter desc");


$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
    
    $cor='background-color:';
    if($result['estado']=='1' && $result['CA_Levantamento']==$result['counter'])
       $cor .='green;';
    else if($result['estado']=='0' && $result['CA_Levantamento']==$result['counter'])
       $cor .='orange;';
    else if($result['estado']=='1')
       $cor .= 'yellow;';
    else
       $cor .='';
    
    
    
    $tableLev .= '<tr id="' . $result["id"] . '">
                    <td class="counter" name="counter" id="counter" style="cursor:pointer;'. $cor.'">' . $result["counter"] . '</td>
                    <td width="300px;">';
    $result["id_cliente"];
    $sql_cliente = $conn_etica->prepare("select intCodigo, strNome from Tbl_Clientes where intCodigo ='" . $result['id_cliente'] . "'");
    $sql_cliente->execute();
    $cliente = $sql_cliente->fetch();
    $tableLev .= $cliente['strNome'];
    $tableLev .= '</td>';

    $textobs = $result["observacoes"];
    $tamanhoObs = strlen($textobs);
    if ($tamanhoObs >= 50) {

        $tableLev .= '<td width="300px;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="' . $result["observacoes"] . '">';
        $tableLev .= substr($textobs, 0, 50) . '...';
//$tableLev .= $tamanhoObs >= 50 ? substr($textobs, 0, 50) . '...' : $textobs;
        $tableLev .= '</td>';
    } else {
        $tableLev .= '<td width="300px;">';
        $tableLev .= $textobs;
        $tableLev .= '</td>';
    }

    $tableLev .= '<td>' . $result["recebido_por"] . '</td>
                     <td>';
    if ($result['prioridade'] == 1) {
        $tableLev .= 'Baixa';
    } elseif ($result['prioridade'] == 2) {
        $tableLev .= 'Média';
    } elseif ($result['prioridade'] == 3) {
        $tableLev .= 'Alta';
    }
    $tableLev .= '</td>
                    <td>';
    $datetimeFromSql = $result["data_hora"];
    $time = strtotime($datetimeFromSql);
    $myFormatForView = date("d/m/Y H:i:s", $time);
    $tableLev .= $myFormatForView;
    $tableLev .= '</td>
                     <td><a class=" tooltipped" data-position="bottom" data-delay="50" data-tooltip="Informação" name="BtnInfo" id="BtnInfo" style="cursor:pointer;"><img src="images/info.png" alt="" width="24" height="24" border="0"></a></td>
                     <td><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ver PDF" target="_blank" href="php/levantamentos/pdfLevantamento.php?a=' . $result['id'] . '" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                     <td><a class="btn-floating waves-effect waves-light yellow darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" name="BtnEdit" id="BtnEdit" value=""><i class="material-icons">mode_edit</i></a></td>
                     <td><a class="btn-floating waves-effect waves-light deep-orange accent-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" name="BtnDelete" id="BtnDelete" value=""><i class="material-icons">delete_forever
                     </i></a></td>
                     </tr>';
}

$tableLev .= ' </tbody>
                </table>';

$tableLev .= '<script> $(document).ready(function () {
$(".tooltipped").tooltip({delay: 50});
});
</script>';


echo $tableLev;
?>