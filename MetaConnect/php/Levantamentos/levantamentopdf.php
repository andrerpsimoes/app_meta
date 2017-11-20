<?php
/*
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
     session_destroy();
     header("Refresh:0");
  }*/

include '../../configs/config2.php'; // eticadata DB
include '../../configs/config.php'; //meta DB


$id_cliente = $_GET['b'];
$id_lastLevantamento = $_GET['a'];

//echo $id_cliente;
//echo $id_lastLevantamento;
?>

<!doctype html>
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
                color: #555;
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

            /** RTL **/
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
                                    Levantamento: <?php echo $id_lastLevantamento; ?><br>
                                    Data: <?php
                                    $statement = $conn_meta->prepare("select data_hora from servico where id = $id_lastLevantamento");
                                    $statement->execute();
                                    $result_data = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result_data as $data) {
                                        $data = $data['data_hora'];
                                        $data_hora = trim($data, ".000");
                                        echo $data_hora;
                                    }
                                    ?><br>

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
            <div class="cliente" style="background-color: #eee; color: black;font-weight: bold;">
                <label>Cliente</label>
            </div>


            <div class="row">
                <?php
                $statement = $conn_etica->prepare("select strNome, strMorada_lin1, strLocalidade, strPostal, strNumContrib, strTelefone from Tbl_Clientes where intCodigo = $id_cliente");
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                //print_r($results);

                foreach ($results as $result) {


                    echo '  
                <div class="input-field" style="width: 100%;float: left;">
                   <b>Nome: </b>' . $result["strNome"] . '<br>
                </div>
            
                <div class="input-field" style="width: 75%;float: left;">
                   <b>Morada: </b>' . $result["strMorada_lin1"] . '<br>
                </div>
            
                <div class="input-field" style="width: 25%;float: left;">
                    <b>Localidade: </b>' . $result["strLocalidade"] . '<br>
                </div>

                <div class="input-field" style="width: 50%;float: left;">
                    <b>Código-Postal: </b>' . $result["strPostal"] . '<br>
                </div>

                <div class="input-field" style="width: 50%;float: left;">
                    <b>Telefone: </b>' . $result["strTelefone"] . '<br>
                </div>
            
                <div class="input-field" style="width: 100%;float: left;">
                   <b>Contribuinte: </b>' . $result["strNumContrib"] . '<br>
                </div>';
                }
                ?>
            </div>

            <br>
            <div class="Levantamento" style="background-color: #eee; color: black;font-weight: bold;width: 100%;float: left;">
                <label>Levantamento</label>
            </div>

            <div class="row">
                <?php
                $statement = $conn_meta->prepare("select recebido_por, pedido_por, prioridade, observacoes from servico where id = $id_lastLevantamento");
                $statement->execute();
                $results_meta = $statement->fetchAll(PDO::FETCH_ASSOC);

//print_r($results);

                foreach ($results_meta as $result) {


                    echo '
                <div class="input-field" style="width: 50%;float: left;">
                   <b>Recebido por: </b>' . $result["recebido_por"] . '<br>
                </div>
            
                <div class="input-field" style="width: 50%;float: left;">
                   <b>Prioridade: </b>';
                    if ($result['prioridade'] == 1) {
                        echo 'Baixa';
                    } elseif ($result['prioridade'] == 2) {
                        echo 'Média';
                    } elseif ($result['prioridade'] == 3) {
                        echo 'Alta';
                    } echo '<br>
                </div>';
                    $stat = $conn_meta->prepare("select la.id_area, a.descricao, (select descricao from area where id=a.id_parent) as pai from servico_area as la, area as a where la.id_servico=$id_lastLevantamento and a.id= la.id_area and la.is_active=1");
                    $stat->execute();
                    $results_meta = $stat->fetchAll(PDO::FETCH_ASSOC);
                    
                    echo "<br><br><br><br><br><pre>";
                    print_r($results_meta);
                    echo "</pre>";
                    
                    echo '
                <div class="input-field" style="width: 100%;float: left;">
                    <b>Área(s): </b>';
                    $result_area = array();
                    foreach ($results_meta as $area) {
                        $result_area[] = $area['descricao'];
                        
                    }
                    echo implode(", ", $result_area);
                    

                    echo '<br>
                    </div>
            
                <div class="input-field" style="width: 100%;float: left;">
                   <b>Observações: </b>' . $result["observacoes"] . '<br>
                </div>';
                }
                ?>
            </div>

        </div>

    </body>
</html>
