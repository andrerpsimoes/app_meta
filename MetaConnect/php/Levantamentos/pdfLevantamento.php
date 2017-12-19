<?php

  include("restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } 


require_once '../mpdf/mpdf.php';
include '../../configs/config.php'; // MetaveiroAppTestes
include '../../configs/config2.php'; // eticadata DB

$id_lastLevantamento = $_GET['a'];

try{
    /*
     * ********** Inicio Querys **************
     */

    $servicoDetails = $conn_meta->prepare("select s.data_hora, s.recebido_por, s.pedido_por, s.prioridade, s.observacoes, s.id_cliente, 
(select id_projeto from projeto_cliente where is_active=1 and id=s.id_proj_cliente) as projeto, s.counter
from servico s
where s.id=$id_lastLevantamento");


    $servicoDetails->execute();
    $servicoDetailsResult = $servicoDetails->fetch();

    $datetimeFromSql = $servicoDetailsResult[0];
    $time = strtotime($datetimeFromSql);
    $myFormatForView = date("d/m/Y H:i:s", $time);
    
    $id_cliente = $servicoDetailsResult[5];
    $id_projeto = $servicoDetailsResult[6];
    $id_counter = $servicoDetailsResult[7];

    //tipos de prioridade existentes
    if ($servicoDetailsResult[3] == 1) {
        $prioridade = ' Baixa';
    } elseif ($servicoDetailsResult[3] == 2) {
        $prioridade = ' Média';
    } elseif ($servicoDetailsResult[3] == 3) {
        $prioridade = ' Alta';
    }



    $infoCliente = $conn_etica->prepare("select strNome, strMorada_lin1, strLocalidade, strPostal, strNumContrib, strTelefone from Tbl_Clientes where intCodigo = $id_cliente");
    $infoCliente->execute();
    $infoClienteResult = $infoCliente->fetch();

    /*
     * ********** Fim Querys **************
     */





    $html = '<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PDF Levantamento</title>


        <style>
            .invoice-box {
                max-width: auto;
                margin: auto;
                padding: 20px;
                border: 0px;
                font-size: 16px;
                line-height: 24px;
                font-family: Helvetica Neue,Helvetica, Helvetica, Arial, sans-serif;
                color: black;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

           
            .rtl {
                direction: rtl;
                font-family: Tahoma,Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
            }

            .rtl table {
                text-align: right;
            }

            .rtl table tr td:nth-child(2) {
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div class="invoice-box col s12">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="../../images/metaveiro.png" style="width:100%; max-width:300px;">
                                </td>


                                <td>
                                    Guia de Levantamento<br>
                                    Levantamento:' . date("Y") . '/'  . $id_counter . '<br>
                                    Data: ' . $myFormatForView . '<br>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Z.I. de Albergaria-a-Velha, Lote 36,<br>
                                    Rua D - Apartado 8 Albergaria-a-Velha,<br>
                                    3854-909 Portugal
                                </td>

                                <td>
                                    Telefone: 234 913 088<br>
                                    Fax: 234 911 689<br>
                                    Email: geral@metaveiro.com
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div class="cliente" style="background-color: #eee; color: black;font-weight: bold;margin-bottom: 10px;">
                <label>Cliente</label>
            </div>


            <div class="row"> 
                <div class="input-field" style="width: 100%;float: left;margin-bottom: 7px;">
                   <b>Nome: </b>' . $infoClienteResult[0] . '<br>
                </div>
            
                <div class="input-field" style="width: 100%;float: left;margin-bottom: 7px;">
                   <b>Morada: </b>' . $infoClienteResult[1] . '<br>
                </div>
            
                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                    <b>Localidade: </b>' . $infoClienteResult[2] . '<br>
                </div>

                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                    <b>Código-Postal: </b>' . $infoClienteResult[3] . '<br>
                </div>

                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                    <b>Telefone: </b>' . $infoClienteResult[5] . '<br>
                </div>
            
                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                   <b>Contribuinte: </b>' . $infoClienteResult[4] . '<br>
                </div>
                
            </div>

            <br>
            <div class="Levantamento" style="background-color: #eee; color: black;font-weight: bold;width: 100%;float: left;margin-bottom: 10px;">
                <label>Levantamento</label>
            </div>

            <div class="row">
                <div class="input-field" style="width: 100%;float: left;margin-bottom: 7px;">
                   <b>Recebido por: </b>' . $servicoDetailsResult[1] . '<br>
                </div>
                
                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                   <b>Pedido por: </b>' . $servicoDetailsResult[2] . '<br>
                </div>
            
                <div class="input-field" style="width: 50%;float: left;margin-bottom: 7px;">
                   <b>Prioridade: </b>' . $prioridade . ' <br>
                </div>';





    $stat = $conn_meta->prepare("select la.id_area, a.descricao, (select descricao from area where id=a.id_parent) as pai from servico_area as la, area as a where la.id_servico=$id_lastLevantamento and a.id= la.id_area and la.is_active=1");
    $stat->execute();
    $results_meta = $stat->fetchAll(PDO::FETCH_ASSOC);



    if ($results_meta) {

        $html .= ' 
                <div class="input-field" style="width: 100%;float: left;margin-bottom: 7px;">
                    <b>Área(s): </b>';
        $seg_ele = array();
        $seg_inc = array();
        $telecom = array();
        $redes = array();
        $infor = array();
        $audiovisuais = array();
        $equi_esc = array();
        foreach ($results_meta as $area) {
            if ($area['pai'] == 'Segurança Eletrónica') {
                $seg_ele[] = $area['descricao'];
            }
            if ($area['pai'] == 'SCIE') {
                $seg_inc[] = $area['descricao'];
            }
            if ($area['pai'] == 'Telecomunicações') {
                $telecom[] = $area['descricao'];
            }

            if ($area['pai'] == 'Redes') {
                $redes[] = $area['descricao'];
            }
            if ($area['pai'] == 'Informática') {
                $infor[] = $area['descricao'];
            }
            if ($area['pai'] == 'AudioVisuais') {
                $audiovisuais[] = $area['descricao'];
            }
            if ($area['pai'] == 'Equipamento Escritório') {
                $equi_esc[] = $area['descricao'];
            }
        }
        $html .= !empty($seg_ele) ? "<br><b><i>Segurança Eletrónica: </i></b>" . implode(", ", $seg_ele) . "<br>" : NULL;
        $html .= !empty($seg_inc) ? "<br><b><i>Segurança contra Incêndios: </i></b>" . implode(", ", $seg_inc) . "<br>" : NULL;
        $html .= !empty($telecom) ? "<br><b><i>Telecomunicações: </i></b>" . implode(", ", $telecom) . "<br>" : NULL;
        $html .= !empty($redes) ? "<br><b><i>Redes: </i></b>" . implode(", ", $redes) . "<br>" : NULL;
        $html .= !empty($infor) ? "<br><b><i>Informática: </i></b>" . implode(", ", $infor) . "<br>" : NULL;
        $html .= !empty($audiovisuais) ? "<br><b><i>AudioVisuais: </i></b>" . implode(", ", $audiovisuais) . "<br>" : NULL;
        $html .= !empty($equi_esc) ? "<br><b><i>Equipamento Escritório: </i></b>" . implode(", ", $equi_esc) . "<br>" : NULL;
        $html .= ' </div>';
    }


    $html .= '<div class="input-field" style="width: 100%;float: left;margin-bottom: 10px;">
                   <b>Observações: </b>' . $servicoDetailsResult[4] . '
                </div>';





    if ($id_projeto) { //caso haja projeto
        $sql_proj = $conn_meta->prepare("select descricao, responsavel, contacto_responsavel, local from projeto where id=$id_projeto and is_active=1");
        $sql_proj->execute();
        $sql_projResult = $sql_proj->fetch();

        $descricao = $sql_projResult[0];
        $responsavel = $sql_projResult[1];
        $contacto_responsavel = $sql_projResult[2];
        $local = $sql_projResult[3];

        $html .= '<div class="input-field" style="width: 100%;float: left;margin-bottom: 40px;">
                <div class="pro" style="width: auto;height: 100px;padding: 2px;border: 2px solid black;">
                    <h3 style="margin-top:2px;margin-bottom: 10px;">Projeto</h3>
                    <div class="descricao" style="width: 100%;float: left;margin-bottom: 1px;" ><i><b>Descricao: </b></i>' . $descricao . '</div>'
                . '<div  style="width: 100%;float: left;margin-bottom: 1px;" ><i><b>Responsável: </b></i>' . $responsavel . '</div>'
                . '<div  style="width: 60%;float: left;margin-bottom: 1px;" ><i><b>Contacto Responsável: </b></i>' . $contacto_responsavel . '</div>'
                . '<div style="width: 30%;float: left;margin-bottom: 1px;"><i><b>Local: </b></i>' . $local . '</div>'
                . '</div></div>';
    }    //fim caso nao haja projeto

    $html .= '
            </div>

        </div>

    </body>
</html>';

    $mpdf = new mPDF('c', 'A4');
    $mpdf->writeHTML($html);
    $mpdf->Output('pdfLevantamento.pdf', 'I');
} catch (Exception $ex) {
    header("Location:../../page-404.php");
}
    
?>