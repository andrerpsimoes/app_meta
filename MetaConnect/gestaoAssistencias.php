<?php
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
if (isset($_GET['logout'])) {
    session_destroy();
    header("Refresh:0");
}
include 'configs/config2.php'; // eticadata DB
include 'configs/config.php'; //meta DB
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'php/infogeral/header.php'; ?>
    </head>
    <body>
        <?php include 'php/infogeral/navSuperior.php'; ?>

        <?php include 'php/infogeral/navEsquerda.php'; ?>
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">
                <!-- START CONTENT -->
                <section id="content" style="margin-bottom: 70px;">
                    <div class="container-fluid">
                        <div class="row">
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

                                <tbody>
                                    <?php
                                    $statement = $conn_meta->prepare("select id, counter, id_cliente, observacoes, recebido_por, prioridade, data_hora, estado from servico where tipo_servico=2 and is_active=1");
                                    $statement->execute();
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($results as $result) {
                                        echo '<tr>
                                    <td class="id_assist" name="id_assist" id="id_assist" style="display: none;">' . $result["id"] . '</td>
                                    <td class="counter" name="counter" id="counter">' . $result["counter"] . '</td>

                                    <td width="300px;">';
                                        $result["id_cliente"];
                                        $sql_cliente = $conn_etica->prepare("select intCodigo, strNome from Tbl_Clientes where intCodigo ='" . $result['id_cliente'] . "'");
                                        $sql_cliente->execute();
                                        $cliente = $sql_cliente->fetch();
                                        echo $cliente['strNome'];
                                        echo '</td>

                                    <td width="300px;">';

                                        $textobs = $result["observacoes"];
                                        $tamanhoObs = strlen($textobs);
                                        echo $tamanhoObs >= 50 ? substr($textobs, 0, 50) . '...' : $textobs;

                                        echo '</td>
                                    <td>' . $result["recebido_por"] . '</td>

                                    <td>';
                                        if ($result['prioridade'] == 1) {
                                            echo 'Baixa';
                                        } elseif ($result['prioridade'] == 2) {
                                            echo 'Média';
                                        } elseif ($result['prioridade'] == 3) {
                                            echo 'Alta';
                                        }
                                        echo '</td>
                                    <td>';
                                        $datetimeFromSql = $result["data_hora"];
                                        $time = strtotime($datetimeFromSql);
                                        $myFormatForView = date("d/m/Y H:i:s", $time);
                                        echo $myFormatForView;
                                        echo '</td>
                                    <td><a target="_blank" href="php/assistencias/pdfAssistencia.php?a=' . $result['id'] . '" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                                    <td><button class="btn-floating waves-effect waves-light yellow darken-3 tooltipped modal-trigger" href="modal1" data-target="#modal1" data-toggle="modal" data-position="bottom" data-delay="50" data-tooltip="Editar" name="BtnEdit" id="BtnEdit" value=""><i class="material-icons">mode_edit</i></button></td>
                                    <td><a class="btn-floating waves-effect waves-light deep-orange accent-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" name="BtnDelete" id="BtnDelete" value=""><i class="material-icons">delete_forever
                                    </i></a></td>
                                    </tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </section>

                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

        <script>
            $(document).ready(function () {
                $('.tooltipped').tooltip({delay: 50});
                $('select').material_select();
                $('#modal1').modal();
                $('.collapsible').collapsible();


                $("button[name='BtnEdit']").click(function () {
                    alert('ok');
                });

                $("a[name='BtnDelete']").click(function () {

                    var id_servico = $(this).closest('tr').children('td.id_assist').text();

                    $.ajax({

                        type: "POST",
                        data: {'id_servico': id_servico},
                        url: 'php/Assistencias/deleteAssist.php',
                        success: function (response) {

                        ///fazer para n reload
                        },
                        error: function () {
                            alert("Erro");
                        }
                    });


                });
            });

        </script>

    </body>
</html>