<?php
include '../../configs/config2.php'; // eticadata DB
include '../../configs/config.php'; //meta DB


$id_cliente = $_POST['id_cliente'];
$id_lastLevantamento = $_POST['id_lastLevantamento'];

echo $id_cliente;
echo $id_lastLevantamento;

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A simple, clean, and responsive HTML invoice template</title>

  
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
                                    Levantamento #: 123<br>
                                    Data: 14/11/2017<br>

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
            $statement = $conn_etica->prepare("select strNome, strMorada_lin1, strLocalidade, strPostal, strNumContrib, strTelefone from Tbl_Clientes where intCodigo = 12");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            //print_r($results);
            
            foreach ($results as $result) {
                
                
              echo '  
                <div class="input-field col s12">
                   <b>Nome: </b>' . $result["strNome"] . '<br>
                </div>
            
                <div class="input-field col s6">
                   <b>Morada: </b>' . $result["strMorada_lin1"] . '<br>
                </div>
            
                <div class="input-field col s6">
                    <b>Localidade: </b>' . $result["strLocalidade"] . '<br>
                </div>

                <div class="input-field col s4">
                    <b>Código-Postal: </b>' . $result["strPostal"] . '<br>
                </div>

                <div class="input-field col s4">
                    <b>Telefone: </b>' . $result["strTelefone"] . '<br>
                </div>
            
                <div class="input-field col s4">
                   <b>Contribuinte: </b>' . $result["strNumContrib"] . '<br>
                </div>';
             }
            ?>
        </div>

            <br>
            <div class="Levantamento" style="background-color: #eee; color: black;font-weight: bold;">
                <label>Levantamento</label>
            </div>

                        <div class="row">
            <?php
            $statement = $conn_meta->prepare("select recebido_pessoa, prioridade, zona, local, contato_responsavel, observacoes from levantamento where id = 19");
            $statement->execute();
            $results_meta = $statement->fetchAll(PDO::FETCH_ASSOC);

            //print_r($results);
            
            $stat = $conn_meta->prepare("select la.id_area, a.descricao from levantamento_area as la, area as a where la.id_levantamento=19 and a.id= la.id_area and la.is_active=1");
            foreach ($results_meta as $result) {
                
                
              echo '  
                <div class="input-field col s12">
                   <b>Recebido por: </b>' . $result["recebido_pessoa"] . '<br>
                </div>
            
                <div class="input-field col s6">
                   <b>Prioridade: </b>' . $result["prioridade"] . '<br>
                </div>
            
                <div class="input-field col s6">
                    <b>Área: </b>' . $result[""] . '<br>
                </div>

                <div class="input-field col s4">
                    <b>Zona: </b>' . $result["zona"] . '<br>
                </div>

                <div class="input-field col s4">
                    <b>Local: </b>' . $result["local"] . '<br>
                </div>
            
                <div class="input-field col s4">
                   <b>Contacto Responsável: </b>' . $result["contato_responsavel"] . '<br>
                </div>';
             }
            ?>
        </div>

        </div>
          
    </body>
</html>
