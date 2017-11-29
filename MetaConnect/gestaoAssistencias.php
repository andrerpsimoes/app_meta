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
                    <div class="container">
                        <div class="row">
                            <h3 class="center" style="margin-bottom: 50px;">Gestão de Assistências</h3>

                            <table class="striped centered">
                                <thead>
                                    <tr>
                                        <th data-field="name"><a class="" style="color: black;">Nº</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Cliente</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Recebido por</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Prioridade</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Data</a></th>
                                        <th data-field="name"><a class="" style="color: black;">Estado</a></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $statement = $conn_meta->prepare("select id, counter, id_cliente, recebido_por, prioridade, data_hora, estado from servico where tipo_servico=2");
                                    $statement->execute();
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($results as $result) {
                                        echo '<tr>
                                    <td>' . $result["counter"] . '</td>
                                    <td>' . $result["id_cliente"] . '</td>
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
                                    <td>' . $result["estado"] . '</td>
                                    <td><a href="php/assistencias/pdfAssistencia.php?a='.$result['id'].'" id="Btnpdf"><img src="images/pdf_icon.png" alt="" width="40" height="40" border="0"></a></td>
                                    <td><button class="btn-floating waves-effect waves-light yellow darken-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" id="editar" name="edit" value="edit"><i class="material-icons">mode_edit</i></button></td>
                                    <td><a class="btn-floating waves-effect waves-light deep-orange accent-3 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" name="btnDelete" value="idDocente"><i class="material-icons">delete_forever
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
            });

        </script>

    </body>
</html>