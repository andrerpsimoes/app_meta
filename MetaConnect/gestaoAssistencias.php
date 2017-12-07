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
                        <div class="row" id="tableContainer">
                            <!-- tableAssist --> 
                        </div>
                    </div>
                </section>

                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>



        <!-- Modal Eliminar -->
        <div id="delete_modal" class="modal">
            <div class="modal-content">
                <h4>Eliminar Assistência</h4>
                <p>Tem a certeza que pretende eliminar esta assistência?</p>
            </div>
            <div class="modal-footer">
                <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
                <a class="modal-action modal-close waves-effect waves-green btn-flat" id="simButton">Sim</a>
            </div>
        </div>

        <!-- Modal Editar -->
        <div id="edit_modal" class="modal" style="width: 80%; height: 80%;">
            <div class="modal-content">

            </div>
            <div class="modal-footer">
                <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
                <a class="modal-action modal-close waves-effect waves-green btn-flat" id="guardarButton">Guardar</a>
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

        <script>

            var gestaoAssistencia = {

                //********variaveis globais********

                MensagemErro: "Ocorreu um erro, por favor contacte o administrador do sistema.",
                idservico: 0,
                //********Fim variaveis globais********

                editButton: function (this_row) {
                    gestaoAssistencia.idservico = this_row.closest('tr').attr('id');

                    $.ajax({
                        type: "POST",
                        data: {id_servico: gestaoAssistencia.idservico},
                        url: 'php/Assistencias/modaleditAssist.php',
                        success: function (response) {
                            $('.modal-content').html(response);
                        },
                        error: function () {
                            alert(gestaoAssistencia.MensagemErro);
                        }
                    });
                    $('#edit_modal').modal('open');
                },

                deleteButton: function (del_this) {
                    gestaoAssistencia.idservico = del_this.closest('tr').attr('id');
                    $('#delete_modal').modal('open');
                },

                simModal: function () {
                    debugger;
                    $.ajax({
                        type: "POST",
                        data: {id_servico: gestaoAssistencia.idservico},
                        url: 'php/Assistencias/deleteAssist.php',
                        success: function (response) {
                            $.ajax({
                                url: 'php/Assistencias/tableAssist.php',
                                success: function (response) {
                                    debugger;
                                    $('#tableContainer').html(response);
                                    Materialize.toast('Assistência eliminada com sucesso!', 3000, 'rounded');
                                },
                                error: function () {
                                    alert(gestaoAssistencia.MensagemErro);
                                }
                            });
                        },
                        error: function () {
                            alert(assistencia.MensagemErro);
                        }
                    });
                },

                cancelarModal: function () {
                    $('#delete_modal').modal('close');
                    $('#edit_modal').modal('close');
                },

                init: function () {

                    $('.tooltipped').tooltip({delay: 50});
                    $('select').material_select();
                    $('.modal').modal();

                    $.ajax({
                        url: 'php/Assistencias/tableAssist.php',
                        success: function (response) {
                            $('#tableContainer').html(response);
                        },
                        error: function () {
                            alert(gestaoAssistencia.MensagemErro);
                        }
                    });
                }
            };

            $(document).ready(function () {

                gestaoAssistencia.init();

                $(document).on("click", "button[name='BtnEdit']", function () {
                    var this_row = $(this);
                    gestaoAssistencia.editButton(this_row);
                });

                $(document).on("click", "a[name='BtnDelete']", function () {
                    var del_this = $(this);
                    gestaoAssistencia.deleteButton(del_this);
                });

                $("#simButton").click(function () {
                    gestaoAssistencia.simModal();
                });

                $("#cancelarButton").click(function () {
                    gestaoAssistencia.cancelarModal();
                });
            });

        </script>

    </body>
</html>